<link rel="stylesheet" type="text/css" href="style/fSearch.css" />
<script type="text/javascript" src="scripts/fSearch.js"></script>

<form id="fSearch" class="fSearch">
    <p>Введите данные для поиска:</p>
    <table>
        <tr>
            <td>
                <p>ФИО мастера: <input type="text" name="s_fio" /></p>
                <p>Телефон: <input type="text" name="s_phone" /></p>
            </td>
            <td>
                <p>День: <select name="s_day">
                    <option value="0">все</option>
                    <?php
                        for ($i = 1; $i < 32; $i++)
                            echo '<option value="' . $i . '">' . $i . '</option>'; 
                    ?>
                </select></p>
                <p>Месяц: <select name="s_month">
                    <option value="0">все</option>
                    <?php 
                        for ($i = 1; $i < 13; $i++) 
                            echo '<option value="' . $i . '">' . $i . '</option>'; 
                    ?>
                </select></p>
                <p>Год: <select name="s_year">
                    <option value="0">все</option>
                    <?php
                        for ($i = 2011; $i < idate("Y")+1; $i++) 
                            echo '<option value="' . $i . '">' . $i . '</option>'; 
                    ?>
                </select></p>
            </td>
            <td>
                <p>Размер оплаты (руб.): <input type="text" name="s_price" /></p>
            </td>
        </tr>
    </table>
    <p><input type="button" onclick="startSearch();" value="Поиск" /></p>
</form>
