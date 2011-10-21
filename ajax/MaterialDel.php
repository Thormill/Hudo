<?php
define('ROOT', '../modules/');
require_once ROOT . 'constants.php';
require_once ROOT . 'database.class.php';
$oDB = new Database($aDatabase['host'], $aDatabase['user'], $aDatabase['pwd'], $aDatabase['name']);

$iMaterial = $oDB->query('
    DELETE FROM `materials_out`
    WHERE `id` = ' . $_POST['id'] . '
');
if($iMaterial == 1)
    echo 'Выданная заготовка удалена.';
else {
    echo '<b>Ошибка базы данных</b><br />';
    echo $oDB->getError();
}
