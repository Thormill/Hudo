<?php
define('ROOT', '../modules/');
require_once ROOT . 'constants.php';
require_once ROOT . 'database.class.php';
$oDB = new Database($aDatabase['host'], $aDatabase['user'], $aDatabase['pwd'], $aDatabase['name']);

$sPhone = $oDB->selectField('
    SELECT `phone`
        FROM `masters`
        WHERE `m_id` = "' . $_POST['m_id'] .'"
');

echo $sPhone;
