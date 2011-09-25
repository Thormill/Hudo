<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Система учета счетов</title>
    <link rel="shortcut icon" href="img/favicon.ico">
    <link rel="stylesheet" type="text/css" href="style/Index.css" />
    <script type="text/javascript" src="scripts/jquery-min.js"></script>
    <script type="text/javascript" src="scripts/Index.js"></script>
</head>
<body>
    <div id="main">
        <ul class="menu">
            <li><a id="AddPayment" href="/nojs.php" onclick="menuClick(this);return false">Добавить платеж</a></li>
            <li><a id="AddMaster" href="/nojs.php" onclick="menuClick(this);return false">Добавить мастера</a></li>
            <li><a id="Search" href="/nojs.php" onclick="menuClick(this);return false">Поиск платежей</a></li>
            <li><a id="Control" href="/nojs.php" onclick="menuClick(this);return false">Управление контентом</a></li>
            <li><a id="ImportExport" href="/nojs.php" onclick="menuClick(this);return false">Импорт/Экспорт</a></li>
        </ul>
        <div id="form"></div>
        <div id="content"></div>
    </div>
    <div id="footer">Белые Ночи © 2011</div>
    <div id="mask"></div>
    <div id="modal">
        <a href="#" id="close">X</a>
        <div id="modal-content"></div>
    </div>
</body>
</html>

 <script type="text/javascript">
    $('#close').click(function (e) {
        e.preventDefault();
        $('#mask, #modal').hide();
    });

    $('#mask').click(function () {
        $(this).hide();
        $('#modal').hide();
    });
 </script>
