<?php
define('ROOT', '../modules/');
require_once ROOT . 'phpexcel/PHPExcel.php';
include_once ROOT . 'phpexcel/PHPExcel/IOFactory.php';
include_once ROOT . 'phpexcel/PHPExcel/Writer/Excel5.php';

$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0);
$aSheet = $objPHPExcel->getActiveSheet();
$aSheet->setTitle('Художники');
$aSheet->getColumnDimension('A')->setWidth(35);
$aSheet->getColumnDimension('B')->setWidth(20);

mysql_connect('localhost','hudo','oduh');
mysql_query('SET NAMES "utf8"');
mysql_select_db('hudo');

$i = 1;
$res = mysql_query("SELECT * FROM masters ORDER BY master_fio");
$aSheet->setCellValue("A1", "Художник");
$aSheet->setCellValue("B1", "Телефон");

while($row = mysql_fetch_array($res)){
	$i++;
	$aSheet->setCellValue("A".$i, $row['master_fio']);
	$aSheet->setCellValue("B".$i, $row['phone']);
}
/*--------------------------------------------------------------*/
$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(1);
$aSheet = $objPHPExcel->getActiveSheet();
$aSheet->setTitle('Изделия');
$aSheet->setCellValue("A1", "Тип изделия");
$aSheet->setCellValue("B1", "Категория");
$aSheet->setCellValue("C1", "Изделие");
$aSheet->setCellValue("D1", "Цена");

$res = mysql_query("SELECT * FROM prices");
$i = 1;
while($row = mysql_fetch_array($res)){
	$i++;
	$type = mysql_query("SELECT type_name FROM types WHERE t_id='".$row['type_id']."'");
	$type_name = mysql_fetch_array($type);
	$cat = mysql_query("SELECT category_name FROM categories WHERE c_id='".$row['category_id']."'");
	$cat_name = mysql_fetch_array($cat);
	$item = mysql_query("SELECT item_name FROM items WHERE i_id='".$row['item_id']."'");
	$item_name = mysql_fetch_array($item);
	$aSheet->setCellValue("A".$i, $type_name['type_name']);     //тип изделия
	$aSheet->setCellValue("B".$i, $cat_name['category_name']); //категория
	$aSheet->setCellValue("C".$i, $item_name['item_name']);     //итем
	$aSheet->setCellValue("D".$i, $row['price']);    //цена
}

$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
$file = (str_replace('.php', '.xlsx', __FILE__));
$objWriter->save($file);
header ("Content-Type: application/octet-stream");
header ("Accept-Ranges: bytes");
header ("Content-Length: ".filesize($file));
header ("Content-Disposition: attachment; filename=".$file);  
readfile($file);
//echo "ok";
?>

