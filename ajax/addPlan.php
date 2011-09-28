<?php
define('ROOT', '../modules/');
require_once ROOT . 'constants.php';
require_once ROOT . 'database.class.php';
$oDB = new Database($aDatabase['host'], $aDatabase['user'], $aDatabase['pwd'], $aDatabase['name']);

$c = 1;
$k = $_POST['Count'];
for ($i = 1; $i <= $k; $i++)
{
    if ($_POST['planpoint' . $i])
    {
        $jsonPlan = str_replace("\\", "", $_POST['planpoint' . $i]);
        $aPlan = json_decode($jsonPlan, true);
        $iInsert = $oDB->insert('
            INSERT INTO `plans`
                SET 
                `plan_number` = ' . $aPlan['number'] . ',
                `item_id`        = ' . $aPlan['item_id'] . ',
                `amount_to_make` = "' . $aPlan['amount_to_make'] . '",
                `amount_remain` = "' . $aPlan['amount_to_make'] . '",
                `price`         = ' . $aPlan['price'] . ',
                `comment`  = "' . $aPlan['comment'] . '",
                `date`          = UNIX_TIMESTAMP()
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
