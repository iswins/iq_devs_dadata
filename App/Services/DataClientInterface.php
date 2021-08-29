<?php
/**
 * Created by v.taneev.
 */


namespace App\Services;


use App\Drivers\CacheDriverInterface;
use App\Exceptions\CompanyNotFound;
use App\Models\DataCompanyInterface;

interface DataClientInterface
{
    /**
     * @param CacheDriverInterface $driver
     * @return $this
     */
    public function setCacheDriver(CacheDriverInterface $driver) : static;

    /**
     * @return $this
     */
    public function enableCache() : static;

    /**
     * @return $this
     */
    public function disableCache() : static;

    /**
     * @param $inn
     * @throws CompanyNotFound
     * @return DataCompanyInterface
     */
    public function getCompanyByInn($inn) : DataCompanyInterface;
}
