<?php
define('ROOT', '../modules/');
require_once ROOT . 'phpexcel/PHPExcel.php';
include_once ROOT . 'phpexcel/PHPExcel/IOFactory.php';
include_once ROOT . 'phpexcel/PHPExcel/Writer/Excel5.php';
require_once ROOT . 'constants.php';
require_once ROOT . 'database.class.php';

$oDB = new Database($aDatabase['host'], $aDatabase['user'], $aDatabase['pwd'], $aDatabase['name']);
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

$sMasters = $oDB->selectTable('
    SELECT `master_fio`, `phone`, `m_id`
        FROM `masters`
    ');
if($sMasters != 0){
	if(isset($_POST['export_settings'][1])){
		$aSheet->setCellValue('A1', 'Художник');
		foreach ($sMasters as $iMaster => $sMaster)
			$aSheet->setCellValue('A' . ($sMaster['m_id']+1), $sMaster['master_fio']);
	}
	if(isset($_POST['export_settings'][2])){
		$aSheet->setCellValue('B1', 'Телефон');
		foreach ($sMasters as $iMaster => $sMaster)
			$aSheet->setCellValue('B' . ($sMaster['m_id']+1), $sMaster['phone']);
	}
}

/*--------------------------------------------------------------*/
//if(isset($_POST['export_settings'][3])){
	$objPHPExcel->createSheet();
	$objPHPExcel->setActiveSheetIndex(1);
	$aSheet = $objPHPExcel->getActiveSheet();
	$aSheet->setTitle('Изделия');

	$aSheet->setCellValue('A1', 'Тип изделия');
	$aSheet->setCellValue('B1', 'Категория');
	$aSheet->setCellValue('C1', 'Изделие');
	$aSheet->setCellValue('D1', 'Цена');

	$aSheet->getColumnDimension('A')->setWidth(15);
	$aSheet->getColumnDimension('B')->setWidth(30);
	$aSheet->getColumnDimension('C')->setWidth(30);
	$aSheet->getColumnDimension('D')->setWidth(10);
	$aSheet->getStyle('A1')->applyFromArray($boldFont)->applyFromArray($left);
	$aSheet->getStyle('B1')->applyFromArray($boldFont)->applyFromArray($left);
	$aSheet->getStyle('C1')->applyFromArray($boldFont)->applyFromArray($left);
	$aSheet->getStyle('D1')->applyFromArray($boldFont)->applyFromArray($center);

	$aItems = $oDB->selectTable('
		SELECT *
		FROM `items`
	');
	foreach($aItems as $iItem => $aItem){
		$sType = $oDB->selectField('SELECT `type_name` FROM `types` WHERE t_id="' . $aItem['type_id'] . '"');
		$sCat = $oDB->selectField('SELECT `category_name` FROM `categories` WHERE `c_id` = "' . $aItem['category_id'] . '"');
		$sItem = $aItem['item_name'];
		$aSheet->setCellValue('A' . ($iItem + 1), $sType);     //тип изделия
		$aSheet->setCellValue('B' . ($iItem + 1), $sCat); //категория
		$aSheet->setCellValue('C' . ($iItem + 1), $sItem);     //итем
		$aSheet->setCellValue('D' . ($iItem + 1), $aItem['price']);    //цена
		$aSheet->getStyle('A' . ($iItem + 1))->applyFromArray($left);
		$aSheet->getStyle('B' . ($iItem + 1))->applyFromArray($left);
		$aSheet->getStyle('C' . ($iItem + 1))->applyFromArray($left);
		$aSheet->getStyle('D' . ($iItem + 1))->applyFromArray($left);
	}
//}
/*-------------------------------------------------------------------------*/
$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(2);
$aSheet = $objPHPExcel->getActiveSheet();
$aSheet->setTitle('Заготовки');

$sMaterials = $oDB->selectTable('
    SELECT `material_name`, `material_id`
        FROM `materials`
    ');
if($sMaterials != 0){
	if(isset($_POST['export_settings'][6])){
		$aSheet->setCellValue('A1', 'Наименование');
		foreach ($sMaterials as $iMaterial => $sMaterial)
			$aSheet->setCellValue('A' . ($sMaterial['material_id']+1), $sMaterial['material_name']);
	}
}
/*-------------------------------------------------------------------------*/
if(isset($_POST['export_settings'][5])){
    $objPHPExcel->createSheet();
    $objPHPExcel->setActiveSheetIndex(3);
    $aSheet = $objPHPExcel->getActiveSheet();
    $aSheet->setTitle('Платежи');

    $aSheet->setCellValue('A1', '#');
    $aSheet->setCellValue('B1', 'Мастер');
    $aSheet->setCellValue('C1', 'Дата');
    $aSheet->setCellValue('D1', 'Вид / Категория / Изделие');
    $aSheet->setCellValue('E1', 'Количество');
    $aSheet->setCellValue('F1', 'Цена');
    $aSheet->setCellValue('G1', 'Комментарий');
    $aSheet->setCellValue('H1', 'Автор комментария');

    $aSheet->getColumnDimension('A')->setWidth(10);
    $aSheet->getColumnDimension('B')->setWidth(30);
    $aSheet->getColumnDimension('C')->setWidth(25);
    $aSheet->getColumnDimension('D')->setWidth(30);
    $aSheet->getColumnDimension('E')->setWidth(10);
    $aSheet->getColumnDimension('F')->setWidth(10);
    $aSheet->getColumnDimension('G')->setWidth(40);
    $aSheet->getColumnDimension('H')->setWidth(40);

    $aSheet->getStyle('A1')->applyFromArray($boldFont)->applyFromArray($left);
    $aSheet->getStyle('B1')->applyFromArray($boldFont)->applyFromArray($left);
    $aSheet->getStyle('C1')->applyFromArray($boldFont)->applyFromArray($left);
    $aSheet->getStyle('D1')->applyFromArray($boldFont)->applyFromArray($center);
    $aSheet->getStyle('E1')->applyFromArray($boldFont)->applyFromArray($left);
    $aSheet->getStyle('F1')->applyFromArray($boldFont)->applyFromArray($left);
    $aSheet->getStyle('G1')->applyFromArray($boldFont)->applyFromArray($left);
    $aSheet->getStyle('H1')->applyFromArray($boldFont)->applyFromArray($left);

    $aPayments = $oDB->selectTable('
        SELECT * FROM payments_history
    ');
    $i = 1;
    $iPnum;
    foreach($aPayments as $iPayment => $aPayment){
        $i++;
		if($aPayment['payment_number'] == $iPnum){
		    $aPayment['payment_number'] = '';
		    $fio = '';
		    $aPayment['date'] = ' ';
		}
		else {
		    $iPnum = $aPayment['payment_number'];
		   	$fio = $oDB->selectField('
		        SELECT `master_fio` FROM `masters` WHERE m_id="' . $aPayment['master_id'] . '"
		    ');
		    $aPayment['date'] = date('Y-M-d / H:m', $aPayment['date']);
		}
		
		$aSheet->setCellValue('A'.$i, $aPayment['payment_number']);
		$aSheet->getStyle('A'.$i)->applyFromArray($center);
		$aSheet->setCellValue('B'.$i, $fio);
		$aSheet->getStyle('B'.$i)->applyFromArray($center);
		$aSheet->setCellValue('C'.$i, $aPayment['date']);
		$aSheet->getStyle('C'.$i)->applyFromArray($center);
		$aSheet->setCellValue('D'.$i, $aPayment['type_name'] . ' / ' . $aPayment['category_name'] . ' / ' . $aPayment['item_name']);
		$aSheet->getStyle('D'.$i)->applyFromArray($center);
		$aSheet->setCellValue('E'.$i, $aPayment['amount']);
		$aSheet->getStyle('E'.$i)->applyFromArray($center);
		$aSheet->setCellValue('F'.$i, $aPayment['price']);
		$aSheet->getStyle('F'.$i)->applyFromArray($center);
		$aSheet->setCellValue('G'.$i, $aPayment['comment_text']);
		$aSheet->getStyle('G'.$i)->applyFromArray($center);
		$aSheet->setCellValue('H'.$i, $aPayment['comment_author']);
		$aSheet->getStyle('H'.$i)->applyFromArray($center);
    }
}
/*----file create----*/
$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
$file = '../files/export.xlsx';
$objWriter->save($file);
echo 'ok';
?>

