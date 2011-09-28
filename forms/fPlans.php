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

<form id="planpreview">
    <div id="currentplan" class="planpreview">
    </div>
</form>

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
	
	<input type="text" name="amount" id="amount" value="1">шт.</input>
	<input type="text" name="price" id="price">руб.</input>
	<input type="button" onClick="AddToList();" value="+" />
    <input type="button" onClick="Add();" value="добавить" />
  </div>
    <input type="text" value="Ваш комментарий" id="comment" />
</form>
<div id = "planlist" class="planlist">
    <?php
        $sPlans = $oDB->selectTable('
            SELECT `plan_number`, `item_id`, `amount_to_make`, `amount_remain`, 
                   `price`, `date`, `comment`
            FROM `plans`
            WHERE `status` = 0
            ORDER BY `plan_number` ASC
        ');
        $plan_id = 0;
        $counter = FALSE;
        
        foreach($sPlans as $iPlan => $aPlan){
			if($plan_id != $aPlan['plan_number']){
			    if($counter == TRUE)
                    echo '</div></div>';
				$counter = TRUE;
				echo '<div class="container"><div class="plan_container">
				      <p>План номер: ' . $aPlan['plan_number'] . '</p> 
				      <p>Дата: ' . $aPlan['date'] . '</p>
				      </div><div class="items_container">';
			}
			$Item = $oDB->selectField('
			    SELECT `item_name`
			    FROM `items`
			    WHERE `i_id` = ' . $aPlan['item_id'] . '
			');
			
			$Category_id = $oDB->selectField('
			    SELECT `category_id`
			    FROM `items`
			    WHERE `i_id` = ' . $aPlan['item_id'] . '
			');
			$Type_id = $oDB->selectField('
			    SELECT `type_id`
			    FROM `items`
			    WHERE `i_id` = ' . $aPlan['item_id'] . '
			');
			
			$Category = $oDB->selectField('
			    SELECT `category_name`
			    FROM `categories`
			    WHERE `c_id` = ' . $Category_id . '
			');
			$Type = $oDB->selectField('
			    SELECT `type_name`
			    FROM `types`
			    WHERE `t_id` = ' . $Type_id . '
			');
			
			echo '<p>';
			echo $Type . ' / ' . $Category . ' / ' . $Item . '<br />';
			echo 'сделано ' . $aPlan['amount_remain'] . ' из ' . $aPlan['amount_to_make'] . '<br />';
			echo '</p>';
			
			if($plan_id != $aPlan['plan_number']){
			    $plan_id = $aPlan['plan_number'];
			}
		}
        
    ?>
</div>
