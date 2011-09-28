<link rel="stylesheet" type="text/css" href="style/fPlans.css" />
<script type="text/javascript" src="scripts/fPlans.js"></script>
<!--
<link rel="stylesheet" type="text/css" href="style/sunny/jquery-ui-1.8.16.custom.css" />
<script type="text/javascript" src="scripts/jquery.ui.datepicker-ru.js"></script>
-->
<?php
define('ROOT', '../modules/');
require_once ROOT . 'constants.php';
require_once ROOT . 'database.class.php';
$oDB = new Database($aDatabase['host'], $aDatabase['user'], $aDatabase['pwd'], $aDatabase['name']);
?>
<div id = "planpreview" class="planpreview"></div>
<form id="PlanControl" class="fControl">
    <p>Здесь можно составить план - указать изделие и требуемое количесто.</p>
  <div id="addplan" class="planadd">
	<SELECT id="type" name="type">
		<option>--тип изделия--</option>
	</SELECT>
	
	<SELECT id="category" name="category">
		<option>--категория изделия--</option>
	</SELECT>
	
	<SELECT id="item" name="item">
		<option>--выберите изделие--</option>
	</SELECT>
	
	<input type="text" name="amount"></input>
	<input type="text" name="price"></input>
	<input type="button" onClick="AddToList();" value="+" />
    
    <input type="button" onClick="Add();" value="добавить" />
  </div>
</form>
<div id = "planlist" class="planlist"></div>
