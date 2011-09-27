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
<form id="">
    <?php
        $sMaterials = $oDB->SelectTable('
           SELECT `id`, `master_id`, `material_id`, `amount`, `date`
            FROM `materials_out`
            WHERE `status` = 0
            ORDER BY `master_id` ASC
        ');
        $m_id = 0;
        foreach($sMaterials as $iMaterial => $sMaterial){
			if($sMaterial['master_id'] != $m_id){
				$m_id = $sMaterial['master_id'];
				$master_fio = $oDB->SelectField('
				    SELECT `master_fio`
				    FROM `masters`
				    WHERE `m_id` = "' . $sMaterial['master_id'] . '"
				');
				echo '<p>Мастер: ' . $master_fio;
			}
            echo '<input type="checkbox" value="' . $sMaterial['id'] . '" 
                 name="material[]" onClick="MaterialClick();">' . $sMaterial['material_id'] . '</input>';
            if($sMaterial['master_id'] != $m_id){
				$m_id = $sMaterial['master_id'];
            echo '</p>';
		    }
		}
    ?>
</form>
