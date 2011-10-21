<?php
define('ROOT', '../modules/');
require_once ROOT . 'constants.php';
require_once ROOT . 'database.class.php';
$oDB = new Database($aDatabase['host'], $aDatabase['user'], $aDatabase['pwd'], $aDatabase['name']);

$iMaterial = $oDB->query('
    UPDATE `materials_out`
    SET `material_id` =  ' . $_POST['material_id'] . ',
        `amount`      =  ' . $_POST['amount'] . ',
        `comment`     = "' . $_POST['comment'] . '"
    WHERE `Id` = ' . $_POST['id']
);
if($iMaterial == 1)
    echo 'Обновлено';
else {
    echo '<b>Ошибка базы данных</b><br />';
    echo $oDB->getError();
}
