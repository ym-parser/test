<?php

return CMap::mergeArray(
	require(dirname(__FILE__).'/main.php'),
	array(
		'components'=>array(
		 'db'=>array(
			'class'=>'CDbConnection',
			'connectionString'=>'mysql:host=localhost;dbname=rusimport_new',
			'username'=>'rusimport_user',
			'password'=>'OPxQ79KB',
			'emulatePrepare'=>true  // необходимо для некоторых версий инсталляций MySQL
		),
		'dbU'=>array(
			'class'=>'CDbConnection',
			'connectionString'=>'mssql:host=192.168.0.208:1433;dbname=T_Uchet',
			'username'=>'sa',
			'password'=>'masterkey',
			//'emulatePrepare'=>true,  // необходимо для некоторых версий инсталляций MySQL
		),
	),
	)
);
