
# tars-log  
------------------------

`Tar log is a 'phptars' remote log module



Installation of cable vehicles



Install using 'composer'

`composer install phptars/tars-log`



The use of



The allocation of the two elements



Instantiate communicator config, which can be configured one by one or through the configuration files distributed by the platform

-Configure a parameter separately
```php
$config  = new \Tars\client\CommunicatorConfig();  
$config->setLocator("tars.tarsregistry.QueryObj@tcp -h 172.16.0.161 -p 17890");  
$config->setModuleName("tedtest");  
$config->setCharsetName("UTF-8");
$config->setLogLevel("INFO");	//log level：`INFO`、`DEBUG`、`WARN`、`ERROR` default INFO
$config->setSocketMode(2);		//Remote log connection mode：1：socket，2：swoole tcp client 3: swoole coroutine tcp client
```
- Profile initialization parameters
```php
$config = new \Tars\client\CommunicatorConfig();
$sFilePath = 'project address/src/conf'; //Profile distribution path
$config->init($sFilePath);
```

###Output log

There are two ways to output logs: one is to directly call the 'logger' mode of 'logservice' to output remote logs, and the other is to output remote logs in combination with 'monitoring' (recommended)



-Calling 'logger' method of 'logservant'
```php
$logServant  = new \Tars\log\LogServant($config);  
$appName = "App";	//app name
$serverName = "server";	//service name
$file = "test.log";	//file name
$format = "%Y%m%d";	//log time
$buffer = ["hahahahaha"];	//Log content, array, each element is a log
$result = $logServant->logger($appName,$serverName,$file,$format,$buffer);
```

- Combined with 'monolog' method (recommended)
```php
$logger = new \Monolog\Logger("tars_logger");
//remote log
$tarsHandler = new \Tars\log\handler\TarsHandler($config);
//local log Here you can add other handlers according to business needs，such as StreamHandler、ElasticSearchHandler 
$streamHandler = new \Monolog\Handler\StreamHandler(ENVConf::$logPath . "/" . __CLASS__  . ".log");

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
```
