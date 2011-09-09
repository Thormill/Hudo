<?php
require_once '../../conf/constants.php';
require_once '../../classes/database.class.php';
$oDB = new Database($aDatabase['host'], $aDatabase['user'], $aDatabase['pwd'], $aDatabase['name']);

$aCategories = $oDB->selectColumn('
    SELECT `category_name`
        FROM `categories`
        WHERE `type_id` = ' . $_POST['iType']
);

echo '<option value="0">--Выберите категорию изделия--</option>';
foreach ($aCategories as $iCategory => $sCategory)
    echo '<option value="' . ($iCategory+1) . '">' . $sCategory . '</option>';
