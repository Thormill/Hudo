<link rel="stylesheet" type="text/css" href="style/fSearch.css" />
<link rel="stylesheet" type="text/css" href="style/sunny/jquery-ui-1.8.16.custom.css" />
<script type="text/javascript" src="scripts/fSearch.js"></script>
<script type="text/javascript" src="scripts/jquery-ui-1.8.16.js"></script>
<script type="text/javascript" src="scripts/jquery-datepicker.js"></script>
<script type="text/javascript" src="scripts/jquery.ui.datepicker-ru.js"></script>


<form id="fSearch" class="fSearch">
    <p>Введите данные для поиска:</p>
    <table>
        <tr>
            <td>
                <p>ФИО мастера: <input type="text" name="s_fio" /></p>
                <p>Телефон: <input type="text" name="s_phone" /></p>
            </td>
            <td>
                <p>Дата: <select id="s_date" name="s_date" onchange="pickDate()">
                    <option value="0">не важно</option>
                    <option value="1">вчера</option>
                    <option value="2">последние 7 дней</option>
                    <option value="3">своя дата</option>
                </select></p>
                <p id="p_datepicker"></p>
            </td>
            <td>
                <p>Размер оплаты (руб.): <input type="text" name="s_price" /></p>
            </td>
        </tr>
    </table>
    <p><input type="button" onclick="startSearch();" value="Поиск" /></p><br />
</form>
