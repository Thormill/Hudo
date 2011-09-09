<form id="fAdd">
    <p>ФИО мастера: <input type="text" name="art_fio" /></p>
    <p>Вид изделия: <select name="type">
<!--подгрузка type из бд-->
    </select></p>
    <p>Категория изделия: <select name="category">
<!--подгрузка category из бд-->
    </select></p>
    <p>Изделие: <select name="item">
<!--подгрузка item из бд-->
    </select></p>
    <p>Количество: <select name="amount">
    <?php
        for($i = 0; $i < 15; $i++)
            echo "<option value =" . $i . ">" . $i . "</option>";
    ?>
    </select></p>
    <p>Цена: <input name="price" type="text" /></p>
    <p><input type="button" onclick="alert($('#fAdd').serialize());" value="Работа оплачена" /></p>
</form>
