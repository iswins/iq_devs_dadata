<?php
/**
 * Created by v.taneev.
 */

use Luracast\Restler\Restler;

require_once __DIR__ . "/../vendor/autoload.php";

$restler = new Restler();
$restler->addAPIClass(\App\Controllers\CompanyController::class, 'api/company');
$restler->handle();
