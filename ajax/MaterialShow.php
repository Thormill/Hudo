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
       SELECT *
       FROM `materials_out`
       ' . $search . '
       ORDER BY `date` DESC
');
$m_id = 0;
$flag = FALSE;

foreach($sMaterials as $iMaterial => $sMaterial){
	$sClose = '<div class="delete" onClick="DeleteMaterial(' . $sMaterial['id'] . ');return false;">X</div>';
	$sEdit = '<div class="delete" onClick="EditMaterial(' . $sMaterial['id'] . ');return false;">[I]</div>';
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
		echo '<div class="container">
		      <div class="master_container">
		      <p>Мастер: <b>' . $master_fio . '</b></p> 
		      <p>Телефон: ' . $master_phone . '</p>
		      <p>Дата выдачи: ' . date('Y-M-d, H:i', $sMaterial['date']) . '</p>
		      <p>Выдал: ' . $sMaterial['giver'] . '</p>
		      </div><div class="materials_container">';
	}
	    if ($sMaterial['amount'] == 0){
	        $material_form = $sClose;
			$material_form .= '<p>' . $material . '</p>';
		}
		else{
		    $material_form = $sClose;
		    $material_form .= $sEdit;
		    $material_form .= '<p id="material_block' . $sMaterial['id'] . '"><input type="button" id="' . $sMaterial['id'] . '" 
              onClick="MaterialClick(this);" value="принять" />' . $material . '
              (<input type="text" id="amount' . $sMaterial['id'] . '" value="' . $sMaterial['amount'] . '" style="width: 25px;" /> штуки)
              </p>
              <p>Комментарий: <i><span id="comment' . $sMaterial['id'] . '">' . $sMaterial['comment'] . '</span></i></p>
              <input type="hidden" value="' . $sMaterial['material_id'] . '" id="material_id' . $sMaterial['id'] . '" / >';
		}
        
        echo $material_form;
	    if($sMaterial['master_id'] != $m_id){
		    $m_id = $sMaterial['master_id']; //временное хранение имени мастера
		}
}
?>
