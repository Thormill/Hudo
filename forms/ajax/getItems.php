<?php
require_once '../../conf/constants.php';
require_once '../../classes/database.class.php';
$oDB = new Database($aDatabase['host'], $aDatabase['user'], $aDatabase['pwd'], $aDatabase['name']);

$aItems = $oDB->selectTable('
    SELECT `i_id`, `item_name`
        FROM `items`
        WHERE `category_id` = ' . $_POST['iCategory']
);

echo '<option value="0">--Выберите изделия--</option>';
foreach ($aItems as $iItem => $aItem)
    echo '<option value="' . $aItem['i_id'] . '">' . $aItem['item_name'] . '</option>';
