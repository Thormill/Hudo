<?php
require_once '../lib/db.php';
require_once '../lib/phpexcel/PHPExcel.php';
include_once '../lib/phpexcel/PHPExcel/IOFactory.php';
include("../lib/phpexcel/PHPExcel/Writer/Excel5.php");

iconv_set_encoding("internal_encoding", "UTF-8");
iconv_set_encoding("input_encoding", "UTF-8");
iconv_set_encoding("output_encoding", "UTF-8");

$objPHPExcel = PHPExcel_IOFactory::load("given.xls");
$objPHPExcel->setActiveSheetIndex(0); //художники
$aSheet = $objPHPExcel->getActiveSheet();
$max =  $aSheet->getHighestRow();
$count = $max-1;

mysql_query("TRUNCATE artists") or die('can not empty tables');
mysql_query("TRUNCATE categories") or die('can not empty tables');
mysql_query("TRUNCATE types") or die('can not empty tables');
mysql_query("TRUNCATE prices") or die('can not empty tables');
mysql_query("TRUNCATE items") or die('can not empty tables');

for($i=2;$i<=$max;$i++){
	$fio = $aSheet->getCell("B".$i)->getValue(); //fio
	$fio = mb_convert_encoding($fio, "UTF-8");
	$phone = $aSheet->getCell("C".$i)->getValue(); //phone

	if(($fio == '') && ($phone == '')){
		$count--;
		continue;
	}

	$query = "INSERT INTO artists (fio,phone) VALUES ('$fio','$phone')";
	mysql_query($query) or die(" fail");
}
echo "<br>добавлено $count новых художников.<br>";

/*
  изделия
*/
$objPHPExcel->setActiveSheetIndex(1); //изделия
$aSheet = $objPHPExcel->getActiveSheet();
$max =  $aSheet->getHighestRow();
$count = 0;
$t_id = $c_id = $i_id = 0;

for($i=2;$i<=$max;$i++){
	$type = $aSheet->getCell("A".$i)->getValue();     //тип изделия
$type = mb_convert_encoding($type, "UTF-8");
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
	if($price != ''){
		$query = "INSERT INTO prices(category_id, type_id, item_id, price) VALUES ('$c_id', '$t_id', '$i_id', '$price')";
		mysql_query($query) or die('insert price error');
	}
}
echo "<br>добавлено $count новых изделий.";
?>

