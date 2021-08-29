<?php
/**
 * Created by v.taneev.
 */


namespace App;


class Configuration
{
    protected static $instance;

    protected $envConfig = [];

    protected function __construct() {
        $this->envConfig = getenv();
    }

    public static function getInstance() {
        return static::$instance ?? static::$instance = new static();
    }

    public function getDaDataPublicKey() {
        return $this->envConfig['DADATA_PUBLIC_KEY'] ?? null;
    }

    public function getDaDataPrivateKey() {
        return $this->envConfig['DADATA_PRIVATE_KEY'] ?? null;
    }

    public function getCacheTtl() {
        return $this->envConfig['CACHE_TTL'] ?? 3600;
    }

    public function getRedisHost() {
        return $this->envConfig['CACHE_REDIS_HOST'] ?? 'localhost:6379';
    }
}
