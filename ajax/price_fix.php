<?php
define('ROOT', '../modules/');
require_once ROOT . 'phpexcel/PHPExcel.php';
include_once ROOT . 'phpexcel/PHPExcel/IOFactory.php';
include_once ROOT . 'phpexcel/PHPExcel/Writer/Excel5.php';
require_once ROOT . 'constants.php';
require_once ROOT . 'database.class.php';

$oDB = new Database($aDatabase['host'], $aDatabase['user'], $aDatabase['pwd'], $aDatabase['name']);

$aPrices = $oDB->selectTable('
	SELECT `i_id`
	FROM `items`'
);


foreach($aPrices as $iPrice => $aPrice){
	$iMovePrice = $oDB->query('
		UPDATE `items`
		SET `price` = (SELECT `price` FROM `prices` WHERE `p_id` = ' . ($iPrice + 1) . ')
		WHERE `i_id` = ' . ($iPrice + 1)
	);
	if($iMovePrice)
	    echo $iPrice . "ok\n";
	else
	    echo $oDB->getError();
}

