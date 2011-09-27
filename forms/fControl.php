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
	  <SELECT id="MasterList" name="m_id" onChange="MasterSelect(this.options[this.selectedIndex].text);">
	    <?php
          $aMasters = $oDB->selectTable('
            SELECT `m_id`, `master_fio`
                    FROM `masters`
                    ORDER BY `master_fio` ASC'
          );
          echo '<option value="0">--Выберите мастера--</option>';
          foreach ($aMasters as $iMaster => $aMaster)
            echo '<option value="' . $aMaster['m_id'] . '">' . $aMaster['master_fio'] . '</option>';
        ?>
	  </SELECT>
	</p>
    <p><label>Телефон:</label><input type="text" name="phone" id="phone"></input></p>
	<p>
	  <span>
	    <input type="button" onClick="addMaster();" value="добавить" id="mbutton" />
	    <input type="button" onClick="MasterClear();" value="снять выделение" />
	  </span>
	</p>
  </div>
</form>

<form id="PremadeControl" class="fControl">
  <div>
    <p>Здесь можно отредактировать заготовки</p>
	<div class="dItems">
	  <SELECT size="5" class="multiselect" id="mItem" onChange="document.getElementById('premade').value = this.options[this.selectedIndex].value">
        <?php
          $sMaterials = $oDB->selectTable('
            SELECT `material_id`, `material_name`
                    FROM `materials`
                    ORDER BY `material_name` ASC'
          );
          echo '<option value="0">--Выберите заготовку--</option>';
          foreach ($sMaterials as $sMaterial => $uMaterial)
            echo '<option value="' . $uMaterial['material_id'] . '">' . $uMaterial['material_name'] . '</option>';
        ?>
	  </SELECT>      
    </div>
	<div>
	  <label for="premade">Название</label><input type="text" id="premade"></input>	  
	</div>
    <input type="button" onClick="" value="изменить" />
  </div>
</form>
