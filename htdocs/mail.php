<?php
$user = 'price@rusimport.com';
$pass = 'RIKPrice2013';

$connect = imap_open('{imap.gmail.com:993/imap/ssl}INBOX',$user, $pass);
if ($connect) echo 'Successful'; else {echo 'Failed'; die;}


$mails = imap_search($connect, 'SUBJECT "Остатки Автоспейс на 28.11.2013"');
echo '<pre>';
var_dump ($mails);
echo '</pre>';
/*

$structure = imap_fetchstructure($connect, $mail);
$boundary = '';

if ($structure->ifparameters) {
	foreach ($structure->parameters as $param){
		if (strtolower($param->attribute) == 'boundary')
			$boundary = $param->value;
	}
}
getParts($structure, $parts);
$parts = array();
function getParts($object, & $parts){
	// Object is multipart
	if ($object->type == 1) {
		foreach ($object->parts as $part){
			getParts($part, $parts);
		}
	}else{
		$p['type'] = $object->type;
		$p['encode'] = $object->encoding;
		$p['subtype'] = $object->subtype;
		$p['bytes'] = $object->bytes;
		if ($object->ifparameters == 1) {
			foreach ($object->parameters as $param){
				$p['params'][] = array('attr' => $param->attribute,'val' => $param->value);
			}
		}
		if ($object->ifdparameters == 1) {
			foreach ($object->dparameters as $param){
				$p['dparams'][] = array('attr' => $param->attribute,'val' => $param->value);
			}
		}
		$p['disp'] = null;
		if ($object->ifdisposition == 1) {
			$p['disp'] = $object->disposition;
		}
		$parts[] = $p;
	}
}
// Get allparts to $parts
*/

?>