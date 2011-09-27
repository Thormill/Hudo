<?php
define('ROOT', '../modules/');
require_once ROOT . 'constants.php';
require_once ROOT . 'database.class.php';
$oDB = new Database($aDatabase['host'], $aDatabase['user'], $aDatabase['pwd'], $aDatabase['name']);

if( (isset($_POST['material_id'])) && ($_POST['material_id'] != 0) )
{
	$uMaterial = $oDB->query('
    UPDATE `materials` 
        SET `material_name` = "' . $_POST['material_name'] . '"
        WHERE `material_id` = "' . $_POST['material_id'] . '"
    ');
    if ($uMaterial != 0)
	  echo "Информация о " . $_POST['material_name'] . " обновлена";
    else
    {
        echo "<b>Ошибка базы данных</b><br />";
        echo $oDB->getError();
    }	  
	exit();
}

$sMaterial = $oDB->selectField('
    SELECT `material_name` 
        FROM `materials`
        WHERE `material_name` = "' . $_POST['material_name'] . '"'
);

if ($sMaterial == "") {
    $iInsert = $oDB->insert('
        INSERT INTO `materials`
            SET `material_name` = "' . $_POST['material_name'] . '"
    ');

    if ($iInsert != 0)
        echo "Заготовка добавлена";
    else
    {
        echo "<b>Ошибка базы данных</b><br />";
        echo $oDB->getError();
    }
} else {
    echo "<b>Ошибка</b><br />";
    echo 'Подобная запись о заготоке уже есть в БД';
}
