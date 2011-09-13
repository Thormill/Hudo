<link rel="stylesheet" type="text/css" href="style/ImportExport.css" />
<link rel="stylesheet" type="text/css" href="style/sunny/jquery-ui-1.8.16.custom.css" />
<script type="text/javascript" src="scripts/jquery-datepicker.js"></script>
<script type="text/javascript" src="scripts/jquery-ui-1.8.16.js"></script>
<script type="text/javascript" src="scripts/fImportExport.js"></script>

<form id="fImport" class="fImport">
    <p>При импортировании все данные, которые есть в системе, будут удалены и заменены на новые.</p>
    <center><input type="button" onclick="Import();" value="Восстановить данные по умолчанию" /></center>
    <p>Выберите файл для импорта<input type="file"></input> <input type=submit value=Загрузить /> </p>
</form>

<form id="fExport" class="fExport">
    <p>Экспорт списка художников и списка изделий.</p>
<div>
    <input type="checkbox" name="export_settings[1]" value="Maters" checked>Художники</input><br>
    <input type="checkbox" name="export_settings[2]" value="Phones" checked>Телефоны</input><br>
</div>
<div>
    <input type="checkbox" name="export_settings[3]" value="Items" checked>Изделия</input><br>
    <input type="checkbox" name="export_settings[4]" value="Prices" checked>Стоимость</input><br>
</div>
<div>
    <input type="checkbox" name="export_settings[5]" value="History">История платежей</input><br>
    <label for="from">c</label><input id="from" type="text"></input>
    <label for="to">по</label><input id="to" type="text"></input>
</div><br>
<p><input type="button" onclick="Export();" value="Экспортировать данные в файл" /></p>
</form>
