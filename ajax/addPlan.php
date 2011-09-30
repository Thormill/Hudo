<?php
define('ROOT', '../modules/');
require_once ROOT . 'constants.php';
require_once ROOT . 'database.class.php';
$oDB = new Database($aDatabase['host'], $aDatabase['user'], $aDatabase['pwd'], $aDatabase['name']);

$c = 1;
$k = $_POST['Count'];
$plan_number = $oDB->selectField('
               SELECT `plan_number` 
               FROM `plans`
               ORDER BY `plan_number` DESC
');
$plan_number++; //номер добавляемого плана больше последнего на один

for ($i = 1; $i <= $k; $i++)
{
    if ($_POST['planpoint' . $i])
    {
        $jsonPlan = str_replace("\\", "", $_POST['planpoint' . $i]);
        $aPlan = json_decode($jsonPlan, true);
        
        $sLeftItems = $oDB->selectField('
			SELECT `amount`
			FROM `left_items`
			WHERE `item_id` = ' . $aPlan['item_id'] . '
        ');
        
        if($sLeftItems) { //если на складе есть нужная вещь
			if($sLeftItems >= $aPlan['amount_to_make']) {
				$tmp = $sLeftItems - $aPlan['amount_to_make'];
				$uLeftItems = $oDB->query('
					UPDATE `left_items`
					SET `amount` = ' . $tmp . '
					WHERE `item_id` = ' . $aPlan['item_id'] . '
				');
			    $iInsert = $oDB->insert('
					INSERT INTO `plans`
					SET 
					`plan_number`    = ' . $plan_number . ',
					`item_id`        = ' . $aPlan['item_id'] . ',
					`amount_to_make` = ' . $aPlan['amount_to_make'] . ',
					`amount_made`    = ' . $aPlan['amount_to_make'] . ' ,
					`price`          = ' . $aPlan['price'] . ',
					`comment`        = "' . $aPlan['comment'] . '",
					`date`           = UNIX_TIMESTAMP(),
					`status`         = 1
				');	
				continue;
			}
			else {
				$uLeftItems = $oDB->query('
					UPDATE `left_items`
					SET `amount` = 0
					WHERE `item_id` = ' . $aPlan['item_id'] . '
				');
			    $iInsert = $oDB->insert('
					INSERT INTO `plans`
					SET 
					`plan_number`    = ' . $plan_number . ',
					`item_id`        = ' . $aPlan['item_id'] . ',
					`amount_to_make` = ' . $aPlan['amount_to_make'] . ',
					`amount_made`    = ' . $sLeftItems . ' ,
					`price`          = ' . $aPlan['price'] . ',
					`comment`        = "' . $aPlan['comment'] . '",
					`date`           = UNIX_TIMESTAMP()
				');	
				continue;
			}
		}
        
        $iInsert = $oDB->insert('
            INSERT INTO `plans`
                SET 
                `plan_number`    = ' . $plan_number . ',
                `item_id`        = ' . $aPlan['item_id'] . ',
                `amount_to_make` = ' . $aPlan['amount_to_make'] . ',
                `amount_made`    =  0 ,
                `price`          = ' . $aPlan['price'] . ',
                `comment`        = "' . $aPlan['comment'] . '",
                `date`           = UNIX_TIMESTAMP()
        ');

        if ($iInsert != 0) {
            echo 'Пункт ' . $c . ' добавлен в план<br />';
            $c++;
        } else {
            echo '<b>Ошибка базы данных</b><br />';
            echo $oDB->getError();
            break;
        }
    }
}
