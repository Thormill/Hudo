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

$boldFont = array(
	'font'=>array(
		'name'=>'Arial Cyr',
		'size'=>'10',
		'bold'=>true
	)
);
$center = array(
	'alignment'=>array(
		'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER
	)
);
$left = array(
	'alignment'=>array(
		'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
		'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER
	)
);
$aSheet->getStyle('A1')->applyFromArray($boldFont)->applyFromArray($center);
$aSheet->getStyle('B1')->applyFromArray($boldFont)->applyFromArray($center);

mysql_connect('localhost','hudo','oduh');
mysql_query('SET NAMES "utf8"');
mysql_select_db('hudo');

$i = 1;
$res = mysql_query("SELECT * FROM masters ORDER BY master_fio");
$aSheet->setCellValue("A1", "Художник");
$aSheet->setCellValue("B1", "Телефон");

while($row = mysql_fetch_array($res)){
	$i++;
	if(isset($_POST['export_settings'][1])){
		$aSheet->setCellValue("A".$i, $row['master_fio']);
	}
	if(isset($_POST['export_settings'][2])){
		$aSheet->setCellValue("B".$i, $row['phone']);
		$aSheet->getStyle('B'.$i)->applyFromArray($center);
	}
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
$aSheet->getColumnDimension('A')->setWidth(15);
$aSheet->getColumnDimension('B')->setWidth(30);
$aSheet->getColumnDimension('C')->setWidth(30);
$aSheet->getColumnDimension('D')->setWidth(10);
$aSheet->getStyle('A1')->applyFromArray($boldFont)->applyFromArray($left);
$aSheet->getStyle('B1')->applyFromArray($boldFont)->applyFromArray($left);
$aSheet->getStyle('C1')->applyFromArray($boldFont)->applyFromArray($left);
$aSheet->getStyle('D1')->applyFromArray($boldFont)->applyFromArray($center);

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
	if(isset($_POST['export_settings'][3])){
		$aSheet->setCellValue("A".$i, $type_name['type_name']);     //тип изделия
		$aSheet->setCellValue("B".$i, $cat_name['category_name']); //категория
		$aSheet->setCellValue("C".$i, $item_name['item_name']);     //итем
	}
	if(isset($_POST['export_settings'][4])){
		$aSheet->setCellValue("D".$i, $row['price']);    //цена
		$aSheet->getStyle('A'.$i)->applyFromArray($left);
		$aSheet->getStyle('B'.$i)->applyFromArray($left);
		$aSheet->getStyle('C'.$i)->applyFromArray($left);
		$aSheet->getStyle('D'.$i)->applyFromArray($left);
	}
}
/*-------------------------------------------------------------------------*/
$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(2);
$aSheet = $objPHPExcel->getActiveSheet();
$aSheet->setTitle('Платежи');

$aSheet->setCellValue("A1", "Мастер");
$aSheet->setCellValue("B1", "Дата");
$aSheet->setCellValue("C1", "Вид/Категория/Изделие");
$aSheet->setCellValue("D1", "Количество");
$aSheet->setCellValue("E1", "Цена");
$aSheet->setCellValue("F1", "комментарий");

$aSheet->getColumnDimension('A')->setWidth(30);
$aSheet->getColumnDimension('B')->setWidth(25);
$aSheet->getColumnDimension('C')->setWidth(30);
$aSheet->getColumnDimension('D')->setWidth(10);
$aSheet->getColumnDimension('E')->setWidth(10);
$aSheet->getColumnDimension('F')->setWidth(40);

$aSheet->getStyle('A1')->applyFromArray($boldFont)->applyFromArray($left);
$aSheet->getStyle('B1')->applyFromArray($boldFont)->applyFromArray($left);
$aSheet->getStyle('C1')->applyFromArray($boldFont)->applyFromArray($left);
$aSheet->getStyle('D1')->applyFromArray($boldFont)->applyFromArray($center);
$aSheet->getStyle('E1')->applyFromArray($boldFont)->applyFromArray($left);
$aSheet->getStyle('F1')->applyFromArray($boldFont)->applyFromArray($left);

$res = mysql_query("SELECT * FROM payments_history");
$i = 1;
while($row = mysql_fetch_array($res)){
	$i++;
	if(isset($_POST['export_settings'][5])){
		$master_fio = mysql_query("SELECT master_fio FROM masters WHERE m_id='".$row['master_id']."'");
                $fio = mysql_fetch_array($master_fio);

		$aSheet->setCellValue("A".$i, $fio['master_fio']);
		$aSheet->getStyle('A'.$i)->applyFromArray($center);
		$aSheet->setCellValue("B".$i, date('Y-M-d / H:m', $row['date']));
		$aSheet->getStyle('B'.$i)->applyFromArray($center);
		$aSheet->setCellValue("C".$i, $row['type_name']." / ".$row['category_name']." / ".$row['item_name']);
		$aSheet->getStyle('C'.$i)->applyFromArray($center);
		$aSheet->setCellValue("D".$i, $row['amount']);
		$aSheet->getStyle('D'.$i)->applyFromArray($center);
		$aSheet->setCellValue("E".$i, $row['price']);
		$aSheet->getStyle('E'.$i)->applyFromArray($center);
		$aSheet->setCellValue("F".$i, $row['comment_id']);
		$aSheet->getStyle('F'.$i)->applyFromArray($center);
	}
}
/*----file create----*/
$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
$file = "../files/export.xlsx";
$objWriter->save($file);
echo "ok";
?>

