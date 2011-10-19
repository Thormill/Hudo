<?php
define('ROOT', '../modules/');
require_once ROOT . 'constants.php';
require_once ROOT . 'database.class.php';
$oDB = new Database($aDatabase['host'], $aDatabase['user'], $aDatabase['pwd'], $aDatabase['name']);

$sMaterials = $oDB->selectTable('
    SELECT `material_id`, `material_name`
    FROM `materials`
    ORDER BY `material_name` ASC
');
foreach ($sMaterials as $sMaterial => $uMaterial)
    echo '<option value="' . $uMaterial['material_id'] . '">' . $uMaterial['material_name'] . '</option>';
