<?php
define('ROOT', '../modules/');
require_once ROOT . 'constants.php';
require_once ROOT . 'database.class.php';
$oDB = new Database($aDatabase['host'], $aDatabase['user'], $aDatabase['pwd'], $aDatabase['name']);

if( ($_POST['table'] == '') || ($_POST['myid'] == 0) )
	exit('нет данных для удаления');

switch($_POST['table']) {
	case 'masters' : 
		$myid = 'm_id';
		break;
	case 'materials' : 
		$myid = 'material_id';
		break;
	case 'types' : 
		$myid = 't_id';
		break;
	case 'categories' : 
		$myid = 'c_id';
		break;
	case 'items' : 
		$myid = 'i_id';
		break;
}

$myquery = 'DELETE FROM `' . $_POST['table'] . '` WHERE `' . $myid . '` = "' . $_POST['myid'] . '"';

$dContent = $oDB->query($myquery);
if($dContent != 0)
	echo "успешно удалено.";
else
    echo "произошло что-то непредвиденное и, возможно, ужасное.\n";
