<?php
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Only Console Application',
	
	'import'=>array(
		'application.models.*',
		'application.controllers.*',
		'application.components.*',
	),
	
	// application components
	'components'=>array(
		 'db'=>array(
			'class'=>'CDbConnection',
			'connectionString'=>'mysql:host=192.168.0.189;dbname=rusimport_new',
			'username'=>'rusimport_user',
			'password'=>'OPxQ79KB',
			'charset' => 'utf8',
			'emulatePrepare'=>true  // необходимо для некоторых версий инсталляций MySQL
		),
		'dbM' => array(
			'class'=>'CDbConnection',
			'connectionString' => 'mysql:host=78.108.82.193;dbname=rusimport',
			  'username' =>  'rusimport_user',
			  'password' => 'OPxQ79KB',
			  'emulatePrepare' => true,
			  'charset' => 'utf8',
			  'schemaCachingDuration'=>3600,
			  'enableProfiling' => true,
			  'enableParamLogging' => true,
		),
	),
);


