<?php
/**
 * Created by v.taneev.
 */


namespace App\Models;


class DaDataCompany implements DataCompanyInterface
{
    protected $raw = [];

    public function __construct($raw) {
        $this->raw = $raw;
    }

    public function getInn ()
    {
        return $this->raw['data']['inn'] ?? null;
    }

    public function getName ()
    {
        return $this->raw['value'] ?? null;
    }
}
