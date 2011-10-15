<?php
define('ROOT', '../modules/');
require_once ROOT . 'phpexcel/PHPExcel.php';
include_once ROOT . 'phpexcel/PHPExcel/IOFactory.php';
require_once ROOT . 'constants.php';
require_once ROOT . 'database.class.php';

$oDB = new Database($aDatabase['host'], $aDatabase['user'], $aDatabase['pwd'], $aDatabase['name']);
$objPHPExcel = PHPExcel_IOFactory::load("../files/given.xlsx");
$objPHPExcel->setActiveSheetIndex(0); //художники
$aSheet = $objPHPExcel->getActiveSheet();
$max =  $aSheet->getHighestRow();
$count = $max-1;$oDB->query('TRUNCATE masters');// or die('can not empty tables');
$oDB->query('TRUNCATE categories');// or die('can not empty tables');
$oDB->query('TRUNCATE types');// or die('can not empty tables');
$oDB->query('TRUNCATE prices');// or die('can not empty tables');
$oDB->query('TRUNCATE items');// or die('can not empty tables');
$oDB->query('TRUNCATE materials');// or die('can not empty tables');

for($i=2;$i<=$max;$i++){
	$j = $i - 1;
	$master_fio = $aSheet->getCell("A".$i)->getValue(); //master_fio
	$phone = $aSheet->getCell("B".$i)->getValue(); //phone
	if( ($master_fio != $aSheet->getCell("A".$j)->getValue()) && ($phone != $aSheet->getCell("B".$j)->getValue()) ){
		if(($master_fio == '') && ($phone == '')){
			$count--;
			continue;
		}
		$mInsert = $oDB->insert('
			INSERT INTO `masters`
			SET `master_fio` = "' . $master_fio . '",
				`phone`      = "' . $phone . '"
		');
	}
}
echo "Добавлено $count художников.<br>";

$objPHPExcel->setActiveSheetIndex(1); //изделия
$aSheet = $objPHPExcel->getActiveSheet();
$max =  $aSheet->getHighestRow();
$count = 0;
$t_id = $c_id = $i_id = 0;

for($i=2;$i<=$max;$i++){
	$j = $i-1;
	$type = $aSheet->getCell("A".$i)->getValue();     //тип изделия
	$category = $aSheet->getCell("B".$i)->getValue(); //категория
	$item = $aSheet->getCell("C".$i)->getValue();     //итем
	$price = $aSheet->getCell("D".$i)->getValue();    //цена
	if($price == '')
		$price = 0;

	if( ($type != '') && ($type != $aSheet->getCell("A".$j)->getValue()) ){
		$t_id++;
		$tInsert = $oDB->insert('
			INSERT INTO `types`
			SET `type_name` = "' . $type . '"
		');
		//mysql_query($type_query) or die('insert type error');
	}

	if(($type != '')&&($category == '')){
		$category = $type;
	}

	if( ($category != '') && ($category != $aSheet->getCell("B".$j)->getValue()) ){
		$c_id++;
		$cInsert = $oDB->insert('
			INSERT INTO `categories`
			SET `category_name` = "' . $category . '",
				`type_id`       = ' . $t_id
				);
	}

	if( ($category != '') && ($item == '') ){
		$item = $category;
	}

	if($item != ''){
		$i_id++;
		$iInsert = $oDB->insert('
			INSERT INTO `items`
			SET `category_id` = ' . $c_id . ',
				`type_id`     = ' . $t_id . ',
				`item_name`   = "' . $item . '"');
		$count++;
	}
	$pInsert = $oDB->insert('
		INSERT INTO `prices`
		SET `type_id`     = ' . $t_id . ',
			`category_id` = ' . $c_id . ',
			`item_id`     = ' . $i_id . ',
			`price`       = ' . $price);	
}
echo "Добавлено $count изделий.<br>";
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
echo "Добавлено $count заготовок.<br>";
?>
