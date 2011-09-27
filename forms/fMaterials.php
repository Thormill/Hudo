<link rel="stylesheet" type="text/css" href="style/fMaterials.css" />
<script type="text/javascript" src="scripts/fMaterials.js"></script>
<!--
<link rel="stylesheet" type="text/css" href="style/sunny/jquery-ui-1.8.16.custom.css" />
<script type="text/javascript" src="scripts/jquery.ui.datepicker-ru.js"></script>
-->
<?php
define('ROOT', '../modules/');
require_once ROOT . 'constants.php';
require_once ROOT . 'database.class.php';
$oDB = new Database($aDatabase['host'], $aDatabase['user'], $aDatabase['pwd'], $aDatabase['name']);
?>
<form id="" class="fControl">
    <?php
        $sMaterials = $oDB->SelectTable('
           SELECT `id`, `master_id`, `material_id`, `amount`, `date`
            FROM `materials_out`
            WHERE `status` = 0
            ORDER BY `master_id` ASC
        ');
        $m_id = 0;
        $counter = 0;
        foreach($sMaterials as $iMaterial => $sMaterial){
			$material = $oDB->SelectField('
				    SELECT `material_name`
				    FROM `materials`
				    WHERE `material_id` = "' . $sMaterial['material_id'] . '"
				');//имя заготовки
				
			if($sMaterial['master_id'] != $m_id){
				if($counter > 0)
                    echo '</div></div>';
				$counter++;
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
				      </div><div class="materials_container">';
			}
			
            echo '<p><input type="checkbox" value="' . $sMaterial['id'] . '" 
                 name="material[]" onClick="MaterialClick(this);">' . $material . '</input>';
            echo '(' . $sMaterial['amount'] . ' штуки)</p>';
            
            if($sMaterial['master_id'] != $m_id){
				$m_id = $sMaterial['master_id']; //временное хранение имени мастера
		    }
		}
    ?>
</form>
