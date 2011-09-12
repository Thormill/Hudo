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

$sQuery = 'SELECT *
    FROM `payments_history`
    WHERE (`master_id` = ' . $aMasters[0]['m_id'];   

foreach ($aMasters as $iMaster => $aMaster)
    $sQuery .= '
        OR `master_id` = ' . $aMaster['m_id'];
$sQuery .= ')';

if ($_POST['s_day'] != 0)
    $sQuery .= '
        AND FROM_UNIXTIME(`date`, "%d") = ' . $_POST['s_day'];

if ($_POST['s_month'] != 0)
    $sQuery .= '
        AND FROM_UNIXTIME(`date`, "%m") = ' . $_POST['s_month'];

if ($_POST['s_year'] != 0)
    $sQuery .= '
        AND FROM_UNIXTIME(`date`, "%Y") = ' . $_POST['s_year'];

$sQuery .= '
    AND LOCATE("' . $_POST['s_price']. '", `price`)
    ORDER BY `h_id` ASC';

$aPayments = $oDB->selectTable($sQuery);

$sTable = '<table>';
foreach ($aPayments as $iPayment => $aPayment) {
    $sTable .= '<tr>
        <td>' . $iPayment . '</td>
        <td>' . $aPayment['date'] . '</td>
        <td>' . $aPayment['date'] . '</td>
        <td>' . $aPayment['type_name'] . ' | ' . $aPayment['category_name'] . ' | ' . $aPayment['item_name'] . '</td>
        <td>' . $aPayment['amount'] . '</td>
        <td>' . $aPayment['price'] . '</td>
        </tr>';
}
$sTable .= '</table>';
print_r($aPayments);
echo $sQuery;
echo $_POST['s_day'];
