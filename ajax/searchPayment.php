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

if ($_POST['s_date'] != 0) {
    if ($_POST['s_date'] == 1)
        $sQuery .= '
            AND FROM_UNIXTIME(`date`, "%d/%m/%Y") = "' . date('d/m/Y', strtotime('-1 day')) . '"';
    if ($_POST['s_date'] == 2)
        $sQuery .= '
            AND FROM_UNIXTIME(`date`, "%d/%m/%Y") > "' . date('d/m/Y', strtotime('-7 day')) . '"';
    if ($_POST['s_date'] == 3)
        $sQuery .= '
            AND FROM_UNIXTIME(`date`, "%d/%m/%Y") = "' . $_POST['datepicker'] . '"';        
}

$sQuery .= '
    AND LOCATE("' . $_POST['s_price']. '", `price`)
    ORDER BY `h_id` ASC
    LIMIT 0, 30';

$aPayments = $oDB->selectTable($sQuery);

if (count($aPayments) > 0) {
    $sTable = '<table class="searchResult">
        <tr>
            <td>#</td>
            <td>ФИО</td>
            <td>Дата</td>
            <td>Вид / Категория / Изделие</td>
            <td>Количество</td>
            <td>Цена</td>
        </tr>';
    foreach ($aPayments as $iPayment => $aPayment) {
        $sMaster = $oDB->selectField('
            SELECT `master_fio`
                FROM `masters`
                WHERE `m_id` = ' . $aPayment['master_id']
        );

        if ($iPayment % 2 == 0)
            $sRowColor = '#bbbbbb';
        else
            $sRowColor = '#ffffff';

        $sTable .= '
            <tr bgcolor="' . $sRowColor . '">
                <td>' . ($iPayment+1) . '</td>
                <td>' . $sMaster . '</td>
                <td>' . date('d.m.Y', $aPayment['date']) . '</td>
                <td>' . $aPayment['type_name'] . ' / ' . $aPayment['category_name'] . ' / ' . $aPayment['item_name'] . '</td>
                <td>' . $aPayment['amount'] . '</td>
                <td>' . $aPayment['price'] . '</td>
            </tr>';
    }
    $sTable .= '
        </table>';
    //print_r($aPayments);
    echo $sTable;
} else
    echo '<p>Поиск не дал результатов</p>';
