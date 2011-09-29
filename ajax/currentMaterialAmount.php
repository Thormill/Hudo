<?php
define('ROOT', '../modules/');
require_once ROOT . 'constants.php';
require_once ROOT . 'database.class.php';
$oDB = new Database($aDatabase['host'], $aDatabase['user'], $aDatabase['pwd'], $aDatabase['name']);

$amount = $oDB->selectField('
	    SELECT `amount`
	    FROM `materials_out`
	    WHERE `id` = "' . $_POST['id'] . '"
');
echo $amount;
