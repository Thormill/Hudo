<?php
define('ROOT', '../modules/');
require_once ROOT . 'constants.php';
require_once ROOT . 'database.class.php';
$oDB = new Database($aDatabase['host'], $aDatabase['user'], $aDatabase['pwd'], $aDatabase['name']);

$sCheck = $oDB->query('
    UPDATE `materials_out`
    SET `status` = "1"
    WHERE `id` = "' . $_POST['id'] . '"
');

if($sCheck != 0){
    echo "принято.";
}
else{
	echo "что-то прошло не так.\nНе могу найти заготовку №" . $_POST['id'] . " в списке выданных.";
}
?>
