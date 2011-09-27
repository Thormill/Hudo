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

<form id="PlanControl" class="fControl">
    <p>Здесь можно составить план - указать изделие и требуемое количесто.</p>
	  <div id="loaded">
	    <SELECT size="5" class="multiselect" id="mType" name="t_id" onChange="TypeClick();">
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
		<SELECT size="5" class="multiselect" id="mCategory" name="c_id" onChange="CategoryClick();">
		    <option value="0">--Выберите категорию изделия--</option>
        </SELECT>
		<SELECT size="5" class="multiselect" id="mItem" name="i_id" onChange="ItemClick();">
	        <option value="0">--Выберите изделие--</option>
		</SELECT>
	    <input type="button" onClick="ItemsClear();" value="Сбросить выбор" />
	  </div>
	  
	  <div id="edited">
	    <label for="atype">Тип</label><input type="text" id="atype" name="type_name" />
	    <label for="acategory">Категория</label><input type="text" id="acategory" name="category_name" />
	    <label for="aitem">Изделие</label><input type="text" id="aitem" name="item_name" />
	    <label for="aamount">Количество</label><input type="text" id="aamount" name="amount" />
	    <label for="aprice">Цена</label><input type="text" id="aprice" name="price" />
        <input type="button" value="Добавить" id="ibutton" onClick="ItemAdd();"/>
	</div>
</form>
