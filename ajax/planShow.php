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
	
	$sClose = '<div class="delete" onClick="deletePlan(' . $aPlan['plan_number'] . ');return false;">X</div>';
	$sEdit = '<div class="edit" onClick="editPlan(' . $aPlan['plan_number'] . ');return false;"><img src="img/edit.png"></div>';
	
	echo '<div class="container"> ' . $sClose . $sEdit . '
	      <div class="plan_container">
	      <p>План номер: ' . $aPlan['plan_number'] . '</p> 
	      <p>Выполнить до: ' . date('Y/M/d', $aPlan['date_to']) . '</p>
	      <p>Добавил: ' . $aPlan['comment_author'] . ', ' . date('Y/M/d H:i', $aPlan['date']) . '</p>
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
	if($aPlan['comment'] != '')
	    $comment = ', <i>' . $aPlan['comment'] . '</i>';
	else
	    $comment = '';
	echo '<p>';
	$p_id = $aPlan['plan_id'];
	echo '<span id="type' . $p_id . '">' . $Type . '</span> / ' . '<span id="category' . $p_id . '">' . $Category .
	     '</span> / ' . '<span id="item' . $p_id . '">' . $Item . '</span><br />';
	echo 'сделано <span id="made' . $p_id . '">' . $aPlan['amount_made'] . '</span> из <span id="make' . $p_id . '">' .
	     $aPlan['amount_to_make'] . '</span>' . '<span id="comment' . $p_id . '">' . $comment . '</span>';
	echo '</p>';
	
	if($plan_id != $aPlan['plan_number']){
	    $plan_id = $aPlan['plan_number'];
	}
}
