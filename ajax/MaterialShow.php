<?php
define('ROOT', '../modules/');
require_once ROOT . 'constants.php';
require_once ROOT . 'database.class.php';
$oDB = new Database($aDatabase['host'], $aDatabase['user'], $aDatabase['pwd'], $aDatabase['name']);

if($_POST['status'] != 'true')
    $search = 'WHERE `status` = 0';
else 
    $search = '';

$sMaterials = $oDB->SelectTable('
       SELECT `id`, `master_id`, `material_id`, `amount`, `date`, `giver`
       FROM `materials_out`
       ' . $search . '
       ORDER BY `date` DESC
');
$m_id = 0;
$flag = FALSE;

foreach($sMaterials as $iMaterial => $sMaterial){
    $material = $oDB->SelectField('
	    SELECT `material_name`
		FROM `materials`
		WHERE `material_id` = "' . $sMaterial['material_id'] . '"
	');//имя заготовки

	if($sMaterial['master_id'] != $m_id){
		if($flag == TRUE)
            echo '</div></div>';
		else
		    $flag = TRUE;
				//отдельный блок под каждого мастера
		$master_fio = $oDB->SelectField('
		    SELECT `master_fio`
		    FROM `masters`
		    WHERE `m_id` = "' . $sMaterial['master_id'] . '"
		');
		$master_phone = $oDB->SelectField('
		    SELECT `phone`
		    FROM `masters`
		    WHERE `m_id` = "' . $sMaterial['master_id'] . '"
		');
		echo '<div class="container"><div class="master_container">
		      <p>Мастер: ' . $master_fio . '</p> 
		      <p>Телефон: ' . $master_phone . '</p>
		      <p>Дата выдачи: ' . date('Y-M-d, H:i', $sMaterial['date']) . '<p>
		      <p>Выдал: ' . $sMaterial['giver'] . '</p>
		      </div><div class="materials_container">';
	}
	    if ($sMaterial['amount'] == 0)
			$material_form = '<p>' . $material . '</p>';
		else
		    $material_form='<p><input type="checkbox" value="' . $sMaterial['id'] . '" 
              onClick="MaterialClick(this);">' . $material . '</input>
              (<input type="text" id="amount' . $sMaterial['id'] . '" value="' . $sMaterial['amount'] . '" /> штуки)</p>';
		
        echo $material_form;
        if($sMaterial['master_id'] != $m_id){
		    $m_id = $sMaterial['master_id']; //временное хранение имени мастера
		}
}
?>
