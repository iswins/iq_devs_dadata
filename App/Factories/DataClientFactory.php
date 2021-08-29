<?php
/**
 * Created by v.taneev.
 */


namespace App\Factories;


use App\Configuration;
use App\Services\DaDataClient;
use App\Services\DataClientInterface;

class DataClientFactory
{
    /**
     * @return DataClientInterface
     */
    public static function getClient() {
        $configuration = Configuration::getInstance();
        $client = new DadataClient($configuration->getDaDataPublicKey(), $configuration->getDaDataPrivateKey());
        $client->setCacheDriver(CacheDriverFactory::getCacheDriver());
        return $client;
    }
}
