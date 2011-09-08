<html>
<head>
<title></title>
<style type="text/css">
    * {font-size: 14px;font-family:Arial;}
</style>
</head>
<body>
    <form>
        <label for="user_fio">ФИО: </label><input id="user_fio" type="text"></input>
        
        <label for="view">Вид: </label><select id="view"></select>
        <label for="category">Категория: </label><select id="category"></select>
        <label for="product">Изделие: </label><select id="product"></select>
        <label for="count">Количество: </label><select id="count"><? for($i = 0; $i < 15; $i++) print('<option value ='.$i.'>'.$i.'</option>') ?></select>
        <label for="cost">Цена: </label><input id="cost" type="text"></input>
        <input type="submit" value="Добавить"></input>

        <div id="content"></div>
    </form>
</body>
</html>
