<?php
define('ROOT', '../modules/');
require_once ROOT . 'constants.php';
require_once ROOT . 'database.class.php';
$oDB = new Database($aDatabase['host'], $aDatabase['user'], $aDatabase['pwd'], $aDatabase['name']);

$iInsert = $oDB->insert('
    INSERT INTO `history`
        SET `master_id` = ' . $_POST['fio'] . ',
        `type_id`       = ' . $_POST['type'] . ',
        `category_id`   = ' . $_POST['category'] . ',
        `item_id`       = ' . $_POST['item']  . ',
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
