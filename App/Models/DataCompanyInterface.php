<?php
/**
 * Created by v.taneev.
 */


namespace App\Models;


interface DataCompanyInterface
{
    /**
     * @return string|null
     */
    public function getInn() : string|null;

    /**
     * @return string|null
     */
    public function getName() : string|null;

    /**
     * @return bool
     */
    public function isOperating() : bool;
}
