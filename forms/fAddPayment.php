<link rel="stylesheet" type="text/css" href="style/fAdd.css" />
<script type="text/javascript" src="scripts/fAddPayment.js"></script>

<?php
define('ROOT', '../modules/');
require_once ROOT . 'constants.php';
require_once ROOT . 'database.class.php';
$oDB = new Database($aDatabase['host'], $aDatabase['user'], $aDatabase['pwd'], $aDatabase['name']);
?>
<table>
    <tr>
        <td>
            <div class="fAdd">
                <p>ФИО мастера: <select name="fio" id="fio" onChange="ShowPhone(this.options[this.selectedIndex].value);">
            <!--подгрузка master из бд-->
                <?php
                    $aMasters = $oDB->selectTable('
                        SELECT `m_id`, `master_fio`
                            FROM `masters`
                            ORDER BY `master_fio` ASC'
                    );
                    echo '<option value="0">--Выберите мастера--</option>';
                    foreach ($aMasters as $iMaster => $aMaster)
                        echo '<option value="' . $aMaster['m_id'] . '">' . $aMaster['master_fio'] . '</option>';
                ?>
                </select>
                </p>
                <p id="phone_info"></p>
                <p>Вид изделия: <select name="type" id="type" onchange="getCategories();">
            <!--подгрузка type из бд-->
                <?php
                    $aTypes = $oDB->selectTable('
                        SELECT `t_id`, `type_name`
                            FROM `types`
                            ORDER BY `type_name` ASC'
                    );
                    echo '<option value="0">--Выберите вид изделия--</option>';
                    foreach ($aTypes as $iType => $aType)
                        echo '<option value="' . $aType['t_id'] . '">' . $aType['type_name'] . '</option>';
                ?>
            <!-- -->
                </select></p>
                <p id="category"></p>
                <p id="item"></p>
                <p id="price"></p>
                <p id="amount"></p>
                <p id="comment"></p>
                <p id="roll_button"></p><br />
            </div>
        </td>
        <td>
            <form id="fAddPayment" class="fAdd">
                <p id="added_payments"></p>
                <p id="add_button"></p>
            </form>
        </td>
    </tr>
</table>