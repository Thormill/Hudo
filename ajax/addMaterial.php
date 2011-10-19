<?php
if (!isset ($_SESSION['username'])) session_start(); 
define('ROOT', '../modules/');
require_once ROOT . 'constants.php';
require_once ROOT . 'database.class.php';
$oDB = new Database($aDatabase['host'], $aDatabase['user'], $aDatabase['pwd'], $aDatabase['name']);

$c = 1;
$k = $_POST['iMaterialCount'];

for ($i = 1; $i <= $k; $i++)
{
    if ($_POST['material' . $i])
    {
        $jsonMaterial = str_replace("\\", "", $_POST['material' . $i]);
        $aMaterial = json_decode($jsonMaterial, true);
		$sMaterial = $oDB->selectField('
			SELECT `id`
			FROM `materials_out`
			WHERE `master_id`    = ' . $aMaterial['master_id'] . '
			AND   `material_id`  = ' . $aMaterial['material_id'] . '
		');
		if($sMaterial != 0){                                            //если у мастера такие заготовки на руках есть
			$sM_Amount = $oDB->selectField('
				SELECT `amount`
				FROM `materials_out`
				WHERE `id` = ' . $sMaterial 
			);
			$sU_Amount = $oDB->query('
				UPDATE `materials_out`
				SET `amount` = ' . $new_val = $sM_Amount + $aMaterial['amount'] . ',
					`date` = UNIX_TIMESTAMP(),
					`comment` = "' . $aMaterial['comment'] . '"
				WHERE `id` = ' . $sMaterial 
			);
			echo 'Заготовка ' . $c . ' добавлена к выданным<br />';
			$c++;
		}
		else{                                                           //если нет заготовок этого типа на руках
			$iInsert = $oDB->insert('
				INSERT INTO `materials_out`
				SET 
					`master_id`    = ' . $aMaterial['master_id'] . ',
					`material_id`  = ' . $aMaterial['material_id'] . ',
					`amount`       = ' . $aMaterial['amount'] . ',
					`giver`        = "' . $_SESSION['username'] . '",
					`status`       = 0,
					`date`         = UNIX_TIMESTAMP(),
					`comment`      = "' . $aMaterial['comment'] . '"
			');
        
			if ($iInsert != 0) {
				echo 'Изделие ' . $c . ' выдано<br />';
				$c++;
			} 
			else {
				echo '<b>Ошибка базы данных!</b><br />';
				echo $oDB->getError();
				break;
			}
		}
    }
}
//`comment_author` = "' . $_SESSION['username'] . '",
