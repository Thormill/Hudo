<?php
define('ROOT', '../modules/');
require_once ROOT . 'constants.php';
require_once ROOT . 'database.class.php';
$oDB = new Database($aDatabase['host'], $aDatabase['user'], $aDatabase['pwd'], $aDatabase['name']);

$i = 1;
while ($_POST['payment' . $i] != '')
{
    $jsonPayment = str_replace("\\", "", $_POST['payment' . $i]);
    $aPayment = json_decode($jsonPayment, true);
    
    $sType = $oDB->selectField('
        SELECT `type_name`
            FROM `types`
            WHERE `t_id` = ' . $aPayment['type']
    );

    $sCategory = $oDB->selectField('
        SELECT `category_name`
            FROM `categories`
            WHERE `c_id` = ' . $aPayment['category']
    );

    $sItem = $oDB->selectField('
        SELECT `item_name`
            FROM `items`
            WHERE `i_id` = ' . $aPayment['item']
    );

    $iInsert = $oDB->insert('
        INSERT INTO `payments_history`
            SET `master_id` = ' . $aPayment['fio'] . ',
            `type_name`     = "' . $sType . '",
            `category_name` = "' . $sCategory . '",
            `item_name`     = "' . $sItem  . '",
            `amount`        = ' . $aPayment['amount'] . ',
            `price`         = ' . $aPayment['price'] . ',
            `comment_text`  = "' . $aPayment['comment'] . '",
            `date`          = UNIX_TIMESTAMP()'
    );
    
    if ($iInsert != 0) {
        echo 'Платеж ' . $i . ' добавлен<br />';
        $i++;
    } else {
        echo '<b>Ошибка базы данных</b><br />';
        echo $oDB->getError();
        break;
    }
}
//`comment_author` = "' . $_SESSION['username'] . '",
