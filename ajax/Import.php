<?php
define('ROOT', '../modules/');
require_once ROOT . 'phpexcel/PHPExcel.php';
include_once ROOT . 'phpexcel/PHPExcel/IOFactory.php';
require_once ROOT . 'constants.php';
require_once ROOT . 'database.class.php';

$oDB = new Database($aDatabase['host'], $aDatabase['user'], $aDatabase['pwd'], $aDatabase['name']);
$objPHPExcel = PHPExcel_IOFactory::load("../files/given.xls");
$objPHPExcel->setActiveSheetIndex(0); //художники
$aSheet = $objPHPExcel->getActiveSheet();
$max =  $aSheet->getHighestRow();
$count = $max-1;
mysql_connect('localhost','hudo','oduh');
mysql_query('SET NAMES "utf8"');
mysql_select_db('hudo');
mysql_query("TRUNCATE masters") or die('can not empty tables');
mysql_query("TRUNCATE categories") or die('can not empty tables');
mysql_query("TRUNCATE types") or die('can not empty tables');
mysql_query("TRUNCATE prices") or die('can not empty tables');
mysql_query("TRUNCATE items") or die('can not empty tables');
mysql_query("TRUNCATE materials") or die('can not empty tables');

for($i=2;$i<=$max;$i++){
	$master_fio = $aSheet->getCell("B".$i)->getValue(); //master_fio
	$phone = $aSheet->getCell("C".$i)->getValue(); //phone

	if(($master_fio == '') && ($phone == '')){
		$count--;
		continue;
	}

	$query = "INSERT INTO masters (master_fio,phone) VALUES ('$master_fio','$phone')";
	mysql_query($query) or die(" fail");
}
echo "Добавлено $count художников.\n";

$objPHPExcel->setActiveSheetIndex(1); //изделия
$aSheet = $objPHPExcel->getActiveSheet();
$max =  $aSheet->getHighestRow();
$count = 0;
$t_id = $c_id = $i_id = 0;

for($i=2;$i<=$max;$i++){
	$type = $aSheet->getCell("A".$i)->getValue();     //тип изделия
	$category = $aSheet->getCell("B".$i)->getValue(); //категория
	$item = $aSheet->getCell("C".$i)->getValue();     //итем
	$price = $aSheet->getCell("D".$i)->getValue();    //цена

	if($type != ''){
		$t_id++;
		$type_query = "INSERT INTO types(type_name) VALUES ('$type')";
		mysql_query($type_query) or die('insert type error');
	}

	if(($type != '')&&($category == '')){
		$category = $type;
	}

	if($category != ''){
		$c_id++;
		$cat_query = "INSERT INTO categories(category_name, type_id) VALUES ('$category', '$t_id')";
		mysql_query($cat_query) or die('insert category error');
	}

	if(($category != '')&&($item == '')){
		$item = $category;
	}

	if($item != ''){
		$i_id++;
		$item_query = "INSERT INTO items(category_id, type_id, item_name) VALUES ('$c_id', '$t_id', '$item')";
		$count++;
		mysql_query($item_query) or die('insert item error');
	}
	$query = "INSERT INTO prices(category_id, type_id, item_id, price) VALUES ('$c_id', '$t_id', '$i_id', '$price')";
	mysql_query($query) or die('insert price error');    //price is set up by default
	
}
echo "Добавлено $count изделий.\n";
/*заготовки*/
$objPHPExcel->setActiveSheetIndex(2); //изделия
$aSheet = $objPHPExcel->getActiveSheet();
$max =  $aSheet->getHighestRow();
$count = 0;
for($i=2;$i<=$max;$i++){
	$material_name = $aSheet->getCell("A".$i)->getValue(); //master_fio

	$iMaterials = $oDB->insert('
	    INSERT INTO `materials`
	    SET `material_name` = "' . $material_name . '"
	');
	$count++;
}
echo "Добавлено $count заготовок.\n";
?>

