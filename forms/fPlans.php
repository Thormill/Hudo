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

<form id="planpreview"></form>

<form id="PlanControl" class="fControl">
    <p>Здесь можно составить план - указать изделие и требуемое количесто.</p>
  <div id="addplan" class="planadd">
	<SELECT id="typelist" name="type" onChange="TypeClick();">
	    <?php
		    $aType = $oDB->selectTable('
            SELECT `t_id`, `type_name`
                    FROM `types`
                    ORDER BY `type_name` ASC'
          );
          echo '<option value="0">--Выберите тип изделия--</option>';
          foreach ($aType as $iType => $aType)
              echo '<option value="' . $aType['t_id'] . '">' . $aType['type_name'] . '</option>';
        ?>
	</SELECT>
	
	<SELECT id="categorylist" name="category" onChange="CategoryClick();">
		<option>--категория изделия--</option>
	</SELECT>
	
	<SELECT id="itemlist" name="item" onChange="ItemClick();">
		<option>--выберите изделие--</option>
	</SELECT>
	
	<input type="text" name="amount" id="amount" value="1" onKeyUp="AmountChange();">шт.</input>
	<input type="text" name="price" id="price">руб.</input>
	<input type="button" onClick="validPlan();" value="+" />
    <input type="button" onClick="Add();" value="добавить" />
  </div>
    Ваш комментарий: <input type="text" value="-" id="comment" />
</form>
	<p><input type="checkbox" id="closed" onChange="PlanShow();">Показывать завершенные планы</input></p>
<div id = "planlist" class="planlist">
    
</div>
