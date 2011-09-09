<?php
require_once '../lib/db.php';
require_once '../lib/phpexcel/PHPExcel.php';
include_once '../lib/phpexcel/PHPExcel/IOFactory.php';
include("../lib/phpexcel/PHPExcel/Writer/Excel5.php");

$objPHPExcel = PHPExcel_IOFactory::load("given.xls");
$objPHPExcel->setActiveSheetIndex(0); //художники
$aSheet = $objPHPExcel->getActiveSheet();
$max =  $aSheet->getHighestRow();
$count = $max-1;
for($i=2;$i<=$max;$i++){
	$fio = $aSheet->getCell("B".$i)->getValue(); //fio
	echo "$fio";
	$phone = $aSheet->getCell("C".$i)->getValue(); //phone
	echo " $phone";

	$res = mysql_query("SELECT * from artists WHERE fio='$fio'");
	if($row = mysql_fetch_array($res) != NULL){
		
			$count--;
			echo " already exists<br>";
			continue;
		
	}

	$query = "INSERT INTO artists (fio,phone) VALUES ('$fio','$phone')";
	mysql_query($query) or die(" fail");
	echo " ok<br>";
}
echo "<br>$count new";
?>
