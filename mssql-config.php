<?
//$HOST = 'rusimport';
$HOST = '192.168.0.208:1433'; // рабочий
//$HOST = '212.119.170.150:14666';
//$HOST = '81.24.112.62:14666';
$USER = 'sa';
$PASS = 'masterkey';
/****** Рабочая версия вызова процедуры ********/
	$conn = mssql_connect ($HOST, $USER, $PASS);
	 $db = 'T_Uchet'; //Имя базы
	 $procedure = 'dbo.GetCalculations'; //название процедуры
	  mssql_select_db($db);
?>