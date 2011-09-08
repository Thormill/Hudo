<?php
require_once '../lib/db.php';
require_once '../lib/phpExcel/PHPExcel.php';
include_once '../lib/phpExcel/PHPExcel/IOFactory.php';
include("../lib/phpExcel/PHPExcel/Writer/Excel5.php");

$objPHPExcel = PHPExcel_IOFactory::load("given.xls");
$objPHPExcel->setActiveSheetIndex(0); //художники
$aSheet = $objPHPExcel->getActiveSheet();

$max =  $aSheet->getHighestRow();
for($i=2;$i<=$max;$i++){
$fio = $aSheet->getCell("B".$i)->getValue()."\r\n"."<br>"; //fio
$phone = $aSheet->getCell("C".$i)->getValue()."\r\n"."<br>"; //phone
$query = "INSERT INTO artists (fio, phone) VALUES ".$fio.", ".$phone;
echo $query;
mysql_query($query) or die("fail while inserting");
}
echo "ok";
?>