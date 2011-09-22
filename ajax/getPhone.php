<?php
define('ROOT', '../modules/');
require_once ROOT . 'constants.php';
require_once ROOT . 'database.class.php';
$oDB = new Database($aDatabase['host'], $aDatabase['user'], $aDatabase['pwd'], $aDatabase['name']);

$mPhone = $oDB->selectField('
    SELECT `phone`
        FROM `masters`
        WHERE `m_id` = "' . $_POST['mId'] .'"
');

echo $mPhone;
