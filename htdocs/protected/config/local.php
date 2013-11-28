<?php
/**
 * Локальная переопределяющая конфигурация
 */

defined('YII_DEBUG') or define('YII_DEBUG', false);
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);

return array(

  'modules'=>(!YII_DEBUG ? array() : array(
    'gii'=>array(
      'password' => '123',
	  'ipFilters' => array('127.0.0.1', '81.24.112.62'),
    ),
  )),

  'components' => array(
    'db' => array(
      'connectionString' => 'mysql:host=78.108.82.193;dbname=rusimport',
      'username' =>  'rusimport_user',
      'password' => 'OPxQ79KB',
      'emulatePrepare' => true,
      'charset' => 'utf8',
      'schemaCachingDuration'=>3600,
      'enableProfiling' => true,
      'enableParamLogging' => true,
    ),
	'dbU'=>array(
			'class'=>'CDbConnection',
			#'connectionString'=>'mssql:host=192.168.0.208:1433;dbname=T_Uchet',
			'connectionString'=>'dblib:host=laf24.ru:14666;dbname=T_Uchet',
			#'connectionString' => 'sqlsrv:server=192.168.0.208\sqlexpress,1433;Database=T_Uchet;',
			'username'=>'sa',
			'password'=>'masterkey',
			'charset' => 'cp1251',
			//'emulatePrepare'=>false,  // необходимо для некоторых версий инсталляций MySQL
		),
    'clientScript' => array(
      'combineCss' => true,
      'combineJs' => true,
    ),

    'log' => array(
      'routes' => array(
        /*
         * Роут для отправки сообщений об ошибках на почту,
         * позволяет при отключенной отладке (на хостинге) отправлять все сообщения об ошибках на e-mail
         */
        /*
        'email_error' => array( //
          'emails' => 'admin@site.com', // кому
          'sentFrom' => 'admin@site.com', //от кого
          'authUser => 'user', //пользователь для авторизации на smtp
          'authPassword' => 'pass', //пароль для авторизации на smtp
          'enabled' => YII_DEBUG == false,
        ),
        */
      ),
    ),
  ),
);


