<link rel="stylesheet" type="text/css" href="style/fControl.css" />
<script type="text/javascript" src="scripts/fControl.js"></script>
<link rel="stylesheet" type="text/css" href="style/sunny/jquery-ui-1.8.16.custom.css" />
<script type="text/javascript" src="scripts/jquery-ui-1.8.16.js"></script>

<?php
define('ROOT', '../modules/');
require_once ROOT . 'constants.php';
require_once ROOT . 'database.class.php';
$oDB = new Database($aDatabase['host'], $aDatabase['user'], $aDatabase['pwd'], $aDatabase['name']);
?>

<form id="fControl" class="fControl">
  <div>
    <p>Здесь можно добавить тип, категорию и само изделие, а также указать его стоимость.<br>
      <label for="type">Тип</label><input type="text" id="type"></input>
      <label for="category">Категория</label><input type="text" id="category"></input>
      <label for="item">Изделие</label><input type="text" id="item"></input>
      <label for="price">Цена</label><input type="text" id="price"></input>
      <input type="button" value="Добавить" onClick=""/>
    </p>
  </div>
  <div class="dItems">
    <p>Здесь можно отредактировать существующую категорию.</p>
      <p><label>Тип</label>      <input type="text"></input><SELECT name="type" /></p>
      <p><label>Категория</label><input type="text"></input><SELECT name="category" /></p>
      <p><label>Изделие</label>  <input type="text"></input><SELECT name="item" /></p>
      <p><label>Цена</label>     <input type="text"></input><SELECT name="price" /></p>
  </div>
</form>

