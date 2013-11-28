<?
$yii='../ygin/yii/yii.php'; // где лежит yii
$config=dirname(__FILE__).'/config/console.php'; // конфиг для консолек который выше описан
 
// remove the following line when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true); // включаем дебаг
require_once($yii);
$app = Yii::createConsoleApplication($config);
// adding PHPExcel autoloader
    Yii::import('application.vendors.*');
    require_once "PHPExcel/PHPExcel.php";
    require_once "PHPExcel/PHPExcel/Autoloader.php";
    Yii::registerAutoloader(array('PHPExcel_Autoloader','Load'), true);
	 $app->run();
#Yii::createConsoleApplication($config)->run(); // и вот тут внимательно  <b>createConsoleApplication</b>
