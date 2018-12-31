<?php
use PhpBenchmarksPhalcon\RestApi\services\BenchmarkMicroApp;

error_reporting(E_ALL);

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

include APP_PATH . '/config/loader.php';


$app=new BenchmarkMicroApp();
$app->handle();