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
            <li><a id="ImportExport" href="/nojs.php" onclick="menuClick(this);return false">Импорт\Экспорт</a></li>
        </ul>
        <div id="form"></div>
        <div id="content"></div>
    </div>
    <div id="footer">Имя вашей кампании © 2011 </div>
</body>
</html>
