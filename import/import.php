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

for($i=2;$i<=$max;$i++){
	$fio = $aSheet->getCell("B".$i)->getValue(); //fio
	$phone = $aSheet->getCell("C".$i)->getValue(); //phone

	if(($fio == '') && ($phone == '')){
		$count--;
		continue;
	}

	$res = mysql_query("SELECT * from artists WHERE fio='$fio'");
	if($row = mysql_fetch_array($res) != NULL){
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

for($i=2;$i<=$max;$i++){
	$type = $aSheet->getCell("A".$i)->getValue();     //тип изделия
	$category = $aSheet->getCell("B".$i)->getValue(); //категория
	$item = $aSheet->getCell("C".$i)->getValue();     //итем
	$price = $aSheet->getCell("D".$i)->getValue();    //цена

	if($type != ''){
		$query = "INSERT INTO types(type_name) VALUES ('$type')";
		mysql_query($query) or die('insert type error');
		$res = mysql_query("SELECT t_id FROM types WHERE type_name='$type'") or die('load type error');
		$row = mysql_fetch_array($res);
		$t_id = $row['t_id']; 
	}
	if($category != ''){
		$query = "INSERT INTO categories(category, type_id) VALUES ('$category', '$t_id')";
		mysql_query($query) or die('insert category error');
		$res = mysql_query("SELECT c_id FROM categories WHERE category='$category'") or die('load category error');
		$row = mysql_fetch_array($res);
		$c_id = $row['c_id']; 
	}
	if($item != ''){
		$query = "INSERT INTO items(category_id, type_id, item) VALUES ('$c_id', '$t_id', '$item')";
		mysql_query($query) or die('insert item error');
		$res = mysql_query("SELECT i_id FROM items WHERE item='$item'") or die('load item error');
		$row = mysql_fetch_array($res);
		$i_id = $row['i_id']; 
	}
	if($price != ''){
		$query = "INSERT INTO prices(category_id, type_id, item_id, price) VALUES ('$c_id', '$t_id', '$i_id', '$price')";
		mysql_query($query) or die('insert price error');
		$count++;
	}
}
echo "<br>добавлено $count новых изделий.";
?>
