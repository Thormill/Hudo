<?php
define('ROOT', '../modules/');
require_once ROOT . 'constants.php';
require_once ROOT . 'database.class.php';
$oDB = new Database($aDatabase['host'], $aDatabase['user'], $aDatabase['pwd'], $aDatabase['name']);

$aMasters = $oDB->selectTable('
    SELECT `m_id`, `master_fio`
    FROM `masters`
    ORDER BY `master_fio` ASC
');
foreach ($aMasters as $iMaster => $aMaster)
    echo $aMaster['master_fio'] . ';';

