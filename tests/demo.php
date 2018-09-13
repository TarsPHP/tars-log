<?php
/**
 * Created by PhpStorm.
 * User: liangchen
 * Date: 2018/4/27
 * Time: 下午3:18.
 */

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Tars\log\handler\TarsHandler;

require_once '../vendor/autoload.php';
$config = new \Tars\client\CommunicatorConfig();
$config->setLocator('tars.tarsregistry.QueryObj@tcp -h 172.16.0.161 -p 17890');
$config->setModuleName('PHPTest.helloTars');
$config->setCharsetName('UTF-8');

$logServant = new \Tars\log\LogServant($config);
try {
    $logServant->logger('PHPTest', 'helloTars', 'ted.log', '%Y%m%d', ['hahahahaha']);
} catch (Exception $e) {
    var_dump((string)$e);
}


$config->setSocketMode(2);
$logServant = new \Tars\log\LogServant($config);
try {
    $logServant->logger('PHPTest', 'helloTars', 'ted2.log', '%Y%m%d', ['huohuohuo']);
} catch (Exception $e) {
    var_dump((string)$e);
}

//use monolog

$logger = new Logger("tars_logger");
$tarsHandler = new TarsHandler($config);
//local log
$streamHandler = new StreamHandler(__DIR__ . '/test.log');

$logger->pushHandler($tarsHandler);
$logger->pushHandler($streamHandler);

$array = [
    "key1" => "value1",
    "key2" => "value2",
    "key3" => "value3"
];
$logger->debug("add a debug message", $array);
$logger->info("add a info message", $array);
$logger->notice("add a notice message", $array);
$logger->warning("add a warning message", $array);
$logger->error("add a error message", $array);
$logger->critical("add a critical message", $array);
$logger->emergency("add a emergency message", $array);
