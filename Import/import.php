<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
require_once '../lib/db.php';
require_once '../lib/phpExcel/PHPExcel.php';
include_once '../lib/phpExcel/PHPExcel/IOFactory.php';
include("../lib/phpExcel/PHPExcel/Writer/Excel5.php");

$objPHPExcel = PHPExcel_IOFactory::load("given.xls");
$objPHPExcel->setActiveSheetIndex(0); //художники
$aSheet = $objPHPExcel->getActiveSheet();
//mysql_query("INSERT INTO artists VALUES 'test','test'") or die("lolo");
$max =  $aSheet->getHighestRow();
for($i=2;$i<=$max;$i++){
	$fio = $aSheet->getCell("B".$i)->getValue(); //fio
	echo "$fio";
	$phone = $aSheet->getCell("C".$i)->getValue(); //phone
	echo "$phone";

	$row = mysql_query("SELECT * from 'artists' WHERE fio='$fio'");
	if(mysql_fetch_array($row)){
		echo "already exists";
		continue;
	}
	$query = "INSERT INTO 'artists' (fio,phone) VALUES '$fio','$phone'";
	//echo "<br>".$query."<br>";
	mysql_query($query) or die(" fail");
	echo "ok";
}
//echo "ok";
?>