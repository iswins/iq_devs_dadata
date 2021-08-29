<?php
/**
 * Created by v.taneev.
 */


namespace App\Controllers;


use App\Factories\DataClientFactory;
use Luracast\Restler\RestException;
use Exception;

class CompanyController
{
    /**
     * @url GET inn/{inn}
     *
     * @param $inn
     * @param  $disableCache
     * @return array
     */
    public function getByInn($inn, $disableCache = 0) {
        $client = DataClientFactory::getClient();
        if (!$disableCache) {
            $client->enableCache();
        }

        try {
            $company = $client->getCompanyByInn($inn);
            return [
                'inn' => $company->getInn(),
                'name' => $company->getName(),
                'is_operating' => $company->isOperating(),
            ];
        } catch (Exception $e) {
            throw new RestException(404, $e->getMessage());
        }
    }
}
