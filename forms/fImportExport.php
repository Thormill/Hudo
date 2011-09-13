<link rel="stylesheet" type="text/css" href="style/ImportExport.css" />
<script type="text/javascript" src="scripts/fImportExport.js"></script>

<form id="fImport" class="fImport">
    <p>При импортировании все данные, которые есть в системе, будут удалены и заменены на новые.</p>
    <input type="button" onclick="Import();" value="Восстановить данные по умолчанию" />
<br><br>
    Выберите файл для импорта<input type="file"></input><input type=submit value=Загрузить>
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
</div>
<p><input type="button" onclick="Export();" value="Экспортировать данные в файл" /></p>
</form>
