<?php
define('ROOT', '../modules/');
require_once ROOT . 'constants.php';
require_once ROOT . 'database.class.php';
$oDB = new Database($aDatabase['host'], $aDatabase['user'], $aDatabase['pwd'], $aDatabase['name']);

$iPlan = $oDB->query('
    DELETE FROM `plans`
    WHERE `plan_number` = ' . $_POST['plan_number'] . '
');
if($iPlan == 1)
    echo 'Информация о плане удалена.';
else {
    echo '<b>Ошибка базы данных</b><br />';
    echo $oDB->getError();
}
