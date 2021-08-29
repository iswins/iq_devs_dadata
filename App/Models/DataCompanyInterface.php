<?php
/**
 * Created by v.taneev.
 */


namespace App\Models;


interface DataCompanyInterface
{
    /**
     * @return string
     */
    public function getInn();

    /**
     * @return string
     */
    public function getName();
}
