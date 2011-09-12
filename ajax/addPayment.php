<?php
define('ROOT', '../modules/');
require_once ROOT . 'constants.php';
require_once ROOT . 'database.class.php';
$oDB = new Database($aDatabase['host'], $aDatabase['user'], $aDatabase['pwd'], $aDatabase['name']);

$sType = $oDB->selectField('
    SELECT `type_name`
        FROM `types`
        WHERE `t_id` = ' . $_POST['type']
);

$sCategory = $oDB->selectField('
    SELECT `category_name`
        FROM `categories`
        WHERE `c_id` = ' . $_POST['category']
);

$sItem = $oDB->selectField('
    SELECT `item_name`
        FROM `items`
        WHERE `i_id` = ' . $_POST['item']
);

$iInsert = $oDB->insert('
    INSERT INTO `payments_history`
        SET `master_id` = ' . $_POST['fio'] . ',
        `type_name`     = "' . $sType . '",
        `category_name` = "' . $sCategory . '",
        `item_name`     = "' . $sItem  . '",
        `amount`        = ' . $_POST['amount'] . ',
        `price`         = ' . $_POST['price'] . ',
        `date`          = UNIX_TIMESTAMP()'
);

if ($iInsert != 0)
    echo "Информация\r\n>> Платеж добавлен";
else
{
    echo "Ошибка базы данных\r\n";
    echo '>> ' . $oDB->getError();
}
