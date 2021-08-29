<?php
/**
 * Created by v.taneev.
 */


namespace App\Factories;


use App\Configuration;
use App\Drivers\CacheDriverInterface;
use App\Drivers\RedisCacheDriver;

class CacheDriverFactory
{
    /**
     * @return CacheDriverInterface
     */
    public static function getCacheDriver() {
        $configuration = Configuration::getInstance();
        return RedisCacheDriver::getInstance($configuration->getRedisHost())
            ->setTtl($configuration->getCacheTtl());
    }
}
