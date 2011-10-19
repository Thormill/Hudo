<link rel="stylesheet" type="text/css" href="style/fControl.css" />
<script type="text/javascript" src="scripts/fControl.js"></script>
<link rel="stylesheet" type="text/css" href="style/sunny/jquery-ui-1.8.16.custom.css" />
<script type="text/javascript" src="scripts/jquery.ui.datepicker-ru.js"></script>

<?php
define('ROOT', '../modules/');
require_once ROOT . 'constants.php';
require_once ROOT . 'database.class.php';
$oDB = new Database($aDatabase['host'], $aDatabase['user'], $aDatabase['pwd'], $aDatabase['name']);
?>

<form id="ItemControl" class="fControl">
  <div>
    <p>Здесь можно добавить тип, категорию и само изделие, а также указать его стоимость.</p>
	  <div id="loaded">
	    <SELECT size="5" class="multiselect" id="mType" name="t_id" onChange="TypeClick();"></SELECT>
		<SELECT size="5" class="multiselect" id="mCategory" name="c_id" onChange="CategoryClick();">
		    <option value="0">----Сначала выберите тип----</option>
        </SELECT>
		<SELECT size="5" class="multiselect" id="mItem" name="i_id" onChange="ItemClick();">
	        <option value="0">--Сначала выберите категорию--</option>
		</SELECT>
	    <input type="button" onClick="ItemsClear();" value="Сбросить выбор" />
	    <input type="button" value="Удалить" id="Dbutton" onClick="Delete();"/>
	  </div>
	  
	  <div id="edited">
	    <label for="atype">Тип</label><input type="text" id="atype" name="type_name" />
	    <label for="acategory">Категория</label><input type="text" id="acategory" name="category_name" />
	    <label for="aitem">Изделие</label><input type="text" id="aitem" name="item_name" />
	    <label for="aprice">Цена</label><input type="text" id="aprice" name="price" />
        <input type="button" value="Добавить" id="ibutton" onClick="ItemAdd();"/>
	</div>
  </div>
</form>

<form id="MasterControl" class="cMasters">
  <div>
    <p>Здесь можно отредактировать мастеров</p>
    <p>
	  <label>Фио:</label>
	  <input type="text" id="fio" name="fio"></input>
	  <SELECT id="MasterList" name="m_id" onChange="MasterSelect(this.options[this.selectedIndex].text);"></SELECT>
	</p>
    <p><label>Телефон:</label><input type="text" name="phone" id="phone"></input></p>
	<p>
	  <span>
	    <input type="button" onClick="addMaster();" value="добавить" id="mbutton" />
	    <input type="button" onClick="MasterClear();" value="снять выделение" />
	    <input type="button" value="Удалить" id="Dbutton" onClick="Delete();"/>
	  </span>
	</p>
  </div>
</form>

<form id="MaterialControl" class="fControl">
  <div>
    <p>Здесь можно отредактировать заготовки</p>
	<div class="dItems">
	  <SELECT size="5" class="multiselect" id="MaterialList" onChange="MaterialClick();" name="material_id"></SELECT>      
    </div>
	<div>
	  <label for="aMaterial">Название</label><input type="text" id="aMaterial" name="material_name"></input>	  
	</div>
    <input type="button" onClick="MaterialAdd();" value="добавить" id="matbutton" />
    <input type="button" onClick="MaterialClear();" value="очистить" />
    <input type="button" value="Удалить" onClick="Delete();"/>
  </div>
</form>
