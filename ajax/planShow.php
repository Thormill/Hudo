<?php
define('ROOT', '../modules/');
require_once ROOT . 'constants.php';
require_once ROOT . 'database.class.php';
$oDB = new Database($aDatabase['host'], $aDatabase['user'], $aDatabase['pwd'], $aDatabase['name']);

$status ='WHERE (1 ';
if( $_POST['closed'] == 'true' )
    $status .= '';
else
    $status .= 'AND `status` = 0';
    
if( $_POST['expired'] != 'true' )
    $status .= ' AND UNIX_TIMESTAMP() < `date_to`';
$status .= ')';
echo $status;

$sPlans = $oDB->selectTable('
        SELECT *
        FROM `plans`
        ' . $status . '
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
		      <p>Выполнить до: ' . date('Y/M/d', $aPlan['date_to']) . '</p>
		      <p>Добавил: ' . $aPlan['comment_author'] . ', ' . date('Y/M/d H:i', $aPlan['date']) . '</p>
		      <p>Комментарий:<i>' . $aPlan['comment'] . '</i></p>
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
	echo 'сделано ' . $aPlan['amount_made'] . ' из ' . $aPlan['amount_to_make'] . '<br />';
	echo '</p>';
	
	if($plan_id != $aPlan['plan_number']){
	    $plan_id = $aPlan['plan_number'];
	}
}
