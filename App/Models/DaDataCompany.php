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

    public function getInn () : string|null
    {
        return $this->raw['data']['inn'] ?? null;
    }

    public function getName () : string|null
    {
        return $this->raw['value'] ?? null;
    }

    public function isOperating (): bool
    {
        return isset($this->raw['data']['state']['status']) &&
            $this->raw['data']['state']['status'] == 'ACTIVE';
    }
}
