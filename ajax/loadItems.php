<?php
define('ROOT', '../modules/');
require_once ROOT . 'constants.php';
require_once ROOT . 'database.class.php';
$oDB = new Database($aDatabase['host'], $aDatabase['user'], $aDatabase['pwd'], $aDatabase['name']);

$aItems = $oDB->selectTable('
    SELECT `i_id`, `item_name`
        FROM `items`
        WHERE `category_id` = ' . $_POST['c_id'] . '
        ORDER BY `item_name` ASC'
);

foreach ($aItems as $iItem => $aItem)
    echo '<option value="' . $aItem['i_id'] . '">' . $aItem['item_name'] . '</option>';
