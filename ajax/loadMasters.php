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
echo '<option value="0">--Выберите мастера--</option>';
foreach ($aMasters as $iMaster => $aMaster)
    echo '<option value="' . $aMaster['m_id'] . '">' . $aMaster['master_fio'] . '</option>';

