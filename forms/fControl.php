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
    </p>
  </div>
  <div>
    <p>Здесь можно отредактировать существующую категорию.<br>
      <SELECT name="type"></SELECT><input type="text"></input><br>
      <SELECT name="category"></SELECT><input type="text"></input><br>
      <SELECT name="item"></SELECT><input type="text"></input><br>
      <SELECT name="price"></SELECT><input type="text"></input><br>
    </p>
  </div>
</form>

