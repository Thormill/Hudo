<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title></title>
<style type="text/css">
    * {font-size: 14px; font-family:Arial;}
    ul.menu {
        list-style: none;
        border-bottom: 1px #888899 solid;
        padding-bottom: 10px;
    }

    ul.menu li {display: inline; margin-right: 5px}

    ul.menu li a {
        color: #888899;
        text-decoration: none;
        background: #f7f7f9;
        border: 1px #bbbbcc solid;
        border-bottom: none;
        padding: 10px 14px
    }

    ul.menu li a:hover {padding: 14px 14px 10px 14px}

    ul.menu li a.selected {
        color: #555566;
        background: #ffffff;
        border: 1px #888899 solid;
        border-bottom: 1px #ffffff solid;
        padding: 14px 14px 10px 14px
    }
</style>
<script type="text/javascript" src="scripts/jquery-1.6.3.js"></script>
<script type="text/javascript">
    function toForm(sFormName)
    {
        $.post("forms/f"+sFormName+".php", null,
            function (data){
                $("#form").html(data);
            });
    }
    function menuClick(objClicked)
    {
        $(".selected").removeClass();
        objClicked.className = "selected";
        toForm(objClicked.id);
    }
</script>
</head>
<body>
<<<<<<< HEAD
    <ul class="menu">
        <li><a id="Add" href="/nojs.php" class="selected" onclick="menuClick(this);return false">Добавить</a></li>
        <li><a id="View" href="/nojs.php" onclick="menuClick(this);return false">Просмотреть</a></li>
        <li><a id="Search" href="/nojs.php" onclick="menuClick(this);return false">Поиск</a></li>
    </ul>
    <div id="form"></div>
    <div id="content"></div>
=======
    <form>
        <label for="user_fio">ФИО: </label><input id="user_fio" type="text"></input>
        
        <label for="view">Вид: </label><select id="view"></select>
        <label for="category">Категория: </label><select id="category"></select>
        <label for="product">Изделие: </label><select id="product"></select>
        <label for="count">Количество: </label><select id="count"><? for($i = 1; $i < 16; $i++) print('<option value ='.$i.'>'.$i.'</option>') ?></select>
        <label for="cost">Цена: </label><input id="cost" type="text"></input>
        <input type="submit" value="Добавить"></input>

        <div id="content"></div>
    </form>
>>>>>>> xls-import
</body>
</html>
