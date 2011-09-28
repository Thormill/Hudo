<?php
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

        $iInsert = $oDB->insert('
            INSERT INTO `materials_out`
              SET 
				`master_id`    = ' . $aMaterial['master_id'] . ',
                `material_id`  = ' . $aMaterial['material_id'] . ',
                `amount`       = ' . $aMaterial['amount'] . ',
				`status`       = 0,
                `date`         = UNIX_TIMESTAMP()
		');
        
        if ($iInsert != 0) {
            echo 'Изделие ' . $c . ' выдано<br />';
            $c++;
        } else {
            echo '<b>Ошибка базы данных!</b><br />';
            echo $oDB->getError();
            break;
        }
    }
}
//`comment_author` = "' . $_SESSION['username'] . '",
