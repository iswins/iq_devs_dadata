<?php
/**
 * Created by v.taneev.
 */


namespace App\Services;


use App\Drivers\CacheDriverInterface;
use App\Exceptions\CompanyNotFound;
use App\Exceptions\ServiceException;
use App\Models\DaDataCompany;
use App\Models\DataCompanyInterface;
use Dadata\DadataClient as RawClient;

class DaDataClient implements DataClientInterface
{
    protected CacheDriverInterface $cacheDriver;
    protected bool $cacheEnabled = false;
    protected RawClient $rawClient;

    public function __construct($token, $secretKey) {
        $this->rawClient = new RawClient($token, $secretKey);
    }

    /**
     * @return RawClient
     */
    public function getRawClient (): RawClient
    {
        return $this->rawClient;
    }

    public function setCacheDriver (CacheDriverInterface $driver): static
    {
        $this->cacheDriver = $driver;
        return $this;
    }

    /**
     * @return CacheDriverInterface
     */
    public function getCacheDriver (): CacheDriverInterface
    {
        return $this->cacheDriver;
    }

    public function enableCache (): static
    {
        $this->cacheEnabled = true;
        return $this;
    }

    public function disableCache (): static
    {
        $this->cacheEnabled = false;
        return $this;
    }

    public function isCacheEnabled() : bool {
        return $this->cacheEnabled;
    }

    public function getCompanyByInn ($inn) : DataCompanyInterface
    {
        $client = $this->getRawClient();
        return $this->query(
            md5(__METHOD__ . $inn),
            function() use ($inn, $client) {
                $response = $client->findById('party', $inn, 1);
                if (!$response) {
                    throw new CompanyNotFound("Company #{$inn} not found!");
                }
                return new DaDataCompany(reset($response));
            }
        );
    }

    protected function query($cacheKey, \Closure $query) {
        if ($result = $this->getFromCache($cacheKey)) {
            return $result;
        }

        $response = $query();
        $this->setCache($cacheKey, $response);
        return $response;
    }

    protected function getFromCache($cacheKey) : mixed {
        if (!$this->isCacheEnabled()) {
            return null;
        }

        if (!$this->cacheDriver) {
            throw new ServiceException("Cache driver isn't set");
        }

        return $this->getCacheDriver()->get($cacheKey);
    }

    protected function setCache($key, $data) : static {
        if (!$this->isCacheEnabled()) {
            return $this;
        }

        if (!$this->cacheDriver) {
            throw new ServiceException("Cache driver isn't set");
        }

        $this->getCacheDriver()->set($key, $data);
        return $this;
    }
}
