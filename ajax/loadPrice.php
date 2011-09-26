<?php
define('ROOT', '../modules/');
require_once ROOT . 'constants.php';
require_once ROOT . 'database.class.php';
$oDB = new Database($aDatabase['host'], $aDatabase['user'], $aDatabase['pwd'], $aDatabase['name']);

$iPrice = $oDB->selectField('
    SELECT `price`
        FROM `prices`
        WHERE `item_id` = ' . $_POST['item_id']
);

echo $iPrice;
