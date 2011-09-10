<?php
require_once '../conf/constants.php';
require_once '../classes/database.class.php';
$oDB = new Database($aDatabase['host'], $aDatabase['user'], $aDatabase['pwd'], $aDatabase['name']);
?>

<form id="fAdd">
    <p>ФИО мастера: <input type="text" name="art_fio" id="art_fio" /></p>
    <p>Вид изделия: <select name="type" id="type" onchange="getCategories();">
<!--подгрузка type из бд-->
    <?php
        $aTypes = $oDB->selectColumn('
            SELECT `type_name`
                FROM `types`'
        );
        echo '<option value="0">--Выберите вид изделия--</option>';
        foreach ($aTypes as $iType => $sType)
            echo '<option value="' . ($iType+1) . '">' . $sType . '</option>';
    ?>
<!-- -->
    </select></p>
    <p>Категория изделия: <select name="category" id="category" onchange="getItems();">
<!-- -->
    </select></p>
    <p>Изделие: <select name="item" id="item">
<!-- -->
    </select></p>
    <p>Количество: <select name="amount" id="amount">
    <?php
        for($i = 0; $i < 15; $i++)
            echo "<option value =" . $i . ">" . $i . "</option>";
    ?>
    </select></p>
    <p>Цена: <input name="price" type="text" id="price" /></p>
    <p><input type="button" onclick="addPayment();" value="Работа оплачена" /></p>
</form>
