<?php
define('ROOT', '../modules/');
require_once ROOT . 'constants.php';
require_once ROOT . 'database.class.php';
$oDB = new Database($aDatabase['host'], $aDatabase['user'], $aDatabase['pwd'], $aDatabase['name']);

$aMasters = $oDB->selectTable('
    SELECT `m_id`, `master_fio`, `phone`
        FROM `masters`
        WHERE LOCATE("' . $_POST['s_fio'] . '" , `master_fio`)
        AND LOCATE("' . $_POST['s_phone'] . '" , `phone`)
        ORDER BY `master_fio` ASC'
);

$aPayments = $oDB->selectTable('
    SELECT * FROM `history`
        WHERE FROM_UNIXTIME(`date`, "%d") = ' . $_POST['s_day'] . '
        AND FROM_UNIXTIME(`date`, "%m") = ' . $_POST['s_month'] . '
        AND FROM_UNIXTIME(`date`, "%Y") = ' . $_POST['s_year']
);

//FROM_UNIXTIME(`date`, "%d %m %Y")
print_r($aPayments);
