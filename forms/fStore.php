<?php
define('ROOT', '../modules/');
require_once ROOT . 'constants.php';
require_once ROOT . 'database.class.php';
$oDB = new Database($aDatabase['host'], $aDatabase['user'], $aDatabase['pwd'], $aDatabase['name']);
?>
<link rel="stylesheet" type="text/css" href="style/fStore.css" />

<div class="store_list">
	<p>На склад попадают вещи, за которые заплачено, но на которых еще не было плана.</p>
	<div>
	<?php
	    $sItems = $oDB->selectTable('
	        SELECT `item_id`, `amount`
	        FROM `left_items`
	    ');
	    foreach($sItems as $iItem => $aItem){
		    $item_name = $oDB->selectField('
		        SELECT `item_name`
		        FROM `items`
		        WHERE `i_id` = ' . $aItem['item_id'] . '
		    ');
		    $category_id = $oDB->selectField('
		        SELECT `category_id`
		        FROM `items`
		        WHERE `i_id` = ' . $aItem['item_id'] . '
		    ');
		    $type_id = $oDB->selectField('
		        SELECT `type_id`
		        FROM `items`
		        WHERE `i_id` = ' . $aItem['item_id'] . '
		    ');
		    $category_name = $oDB->selectField('
		        SELECT `category_name`
		        FROM `categories`
		        WHERE `c_id` = ' . $category_id . '
		    ');
		    $type_name = $oDB->selectField('
		        SELECT `type_name`
		        FROM `types`
		        WHERE `t_id` = ' . $type_id . '
		    ');
		    echo '<p>' . $aItem['amount'] . ' шт. ' . $type_name . ' / ' . $category_name . ' / ' . $item_name . '</p>';
		}
	?>
	</div>
</div>
