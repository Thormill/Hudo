<?php
require_once '../../conf/constants.php';
require_once '../../classes/database.class.php';
$oDB = new Database($aDatabase['host'], $aDatabase['user'], $aDatabase['pwd'], $aDatabase['name']);

$aItems = $oDB->selectColumn('
    SELECT `item_name`
        FROM `items`
        WHERE `category_id` = ' . $_POST['iCategory']
);

echo '<option value="0">--Выберите изделия--</option>';
foreach ($aItems as $iItem => $sItem)
    echo '<option value="' . ($iItem+1) . '">' . $sItem . '</option>';
