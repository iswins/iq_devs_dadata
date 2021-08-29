<?php
/**
 * Created by v.taneev.
 */


namespace App\Drivers;

use Redis;

class RedisCacheDriver implements CacheDriverInterface
{
    protected static $instance;

    protected $ttl = 3600;
    /**
     * @var Redis
     */
    protected $connection;

    protected function __construct($host) {
        $redis = new Redis();
        list($host, $port) = explode(":", $host);
        $redis->connect($host, $port ?? 6379);
        $this->connection = $redis;
    }

    public static function getInstance($host) {
        return static::$instance ?? static::$instance = new static($host);
    }

    public function setTtl ($ttl) : static
    {
        $this->ttl = $ttl;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTtl ()
    {
        return $this->ttl;
    }

    public function get ($key)
    {
        $data = $this->getConnection()->get($key);
        return unserialize($data);
    }

    public function set ($key, $data) : static
    {
        $stringData = serialize($data);
        $this->getConnection()->set($key, $stringData, $this->getTtl());
        return $this;
    }

    /**
     * @return Redis
     */
    public function getConnection (): Redis
    {
        return $this->connection;
    }


}
