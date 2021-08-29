<?php
/**
 * Created by v.taneev.
 */


namespace App\Drivers;

interface CacheDriverInterface
{
    /**
     * @param $ttl
     * @return $this
     */
    public function setTtl($ttl) : static;

    /**
     * @param $key
     * @return mixed
     */
    public function get($key);

    /**
     * @param $key
     * @param $data
     * @return $this
     */
    public function set($key, $data) : static;
}
