<?php
define('ROOT', '../modules/');
require_once ROOT . 'constants.php';
require_once ROOT . 'database.class.php';
$oDB = new Database($aDatabase['host'], $aDatabase['user'], $aDatabase['pwd'], $aDatabase['name']);

$aTypes = $oDB->selectTable('
    SELECT *
        FROM `types`
        ORDER BY `type_name` ASC'
);

foreach ($aTypes as $iType => $aType)
    echo '<option value="' . $aType['t_id'] . '">' . $aType['type_name'] . '</option>';
