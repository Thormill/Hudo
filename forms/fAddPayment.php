<?php
define('ROOT', '../modules/');
require_once ROOT . 'constants.php';
require_once ROOT . 'database.class.php';
$oDB = new Database($aDatabase['host'], $aDatabase['user'], $aDatabase['pwd'], $aDatabase['name']);
?>
<script type="text/javascript" src="scripts/jsAddPayment.js"></script>
<form id="fAdd">
    <p>ФИО мастера: <select name="fio" id="fio">
<!--подгрузка artist из бд-->
    <?php
        $aMasters = $oDB->selectTable('
            SELECT `m_id`, `master_fio`
                FROM `masters`
                ORDER BY `master_fio` ASC'
        );
        echo '<option value="0">--Выберите мастера--</option>';
        foreach ($aMasters as $iMaster => $aMaster)
            echo '<option value="' . $aMaster['m_id'] . '">' . $aMaster['master_fio'] . '</option>';
    ?>
    </select></p>
    <p>Вид изделия: <select name="type" id="type" onchange="getCategories();">
<!--подгрузка type из бд-->
    <?php
        $aTypes = $oDB->selectColumn('
            SELECT `type_name`
                FROM `types`
                ORDER BY `type_name` ASC'
        );
        echo '<option value="0">--Выберите вид изделия--</option>';
        foreach ($aTypes as $iType => $sType)
            echo '<option value="' . ($iType+1) . '">' . $sType . '</option>';
    ?>
<!-- -->
    </select></p>
    <p id="category"></p>
    <p id="item"></p>
    <p id="amount"></p>
    <p id="price"></p>
    <p id="addbutton"></p>
</form>