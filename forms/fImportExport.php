<link rel="stylesheet" type="text/css" href="style/ImportExport.css" />
<script type="text/javascript" src="scripts/fImportExport.js"></script>

<form id="fImport" class="fImport">
    <p>При импортировании все данные, которые есть в системе, будут удалены и заменены на новые.</p>
    <p><input type="button" onclick="Import();" value="Импортировать данные из файла" /></p>
<br>
    <p>Выберите файл для импорта<input type="file"></input><input type=submit value=Загрузить></p>
</form>

<form id="fExport" class="fExport">
    <p>Экспорт списка художников и списка изделий.</p>
    <p><input type="checkbox" name="export_settings" value="Maters">Художники + телефоны</p>
    <p><input type="checkbox" name="export_settings" value="Items" checked>Изделия</p> 
    <p><input type="button" onclick="Export();" value="Экспортировать данные в файл" /></p>
</form>
