<?php
// comment out the following line to disable debug mode
defined('YII_DEBUG') or define('YII_DEBUG', true);

require(__DIR__ . '/../vendor/yiisoft/yii2/yii/Yii.php');
@require(__DIR__ . '/../vendor/autoload.php');
/**
* set comm yii path
*/
//$frameworkPath = __DIR__ . '/../../yii2/framework/yii'; 
//require($frameworkPath . '/Yii.php');
//require(__DIR__ . '/../protected/core/helpers.php');
if(true === YII_DEBUG){
	error_reporting(E_ALL & ~(E_STRICT | E_NOTICE));
	if(!file_exists(__DIR__.'/assets'))
		mkdir(__DIR__.'/assets',0775);
	if(!file_exists(__DIR__.'/../protected/runtime'))
		mkdir(__DIR__.'/../protected/runtime',0775);
}else
	error_reporting(0);
//
$config = require(__DIR__ . '/../protected/config/main.php');




$application = new yii\web\Application($config);
$application->run();
