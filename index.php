<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title></title>
<link rel="stylesheet" type="text/css" href="style/main.css" />
<script type="text/javascript" src="scripts/jquery-1.6.3.js"></script>
<script type="text/javascript" src="scripts/functions.js"></script>
</head>
<body>
    <ul class="menu">
        <li><a id="AddPayment" href="/nojs.php" onclick="menuClick(this);return false">Добавить платеж</a></li>
        <li><a id="ViewMaster" href="/nojs.php" onclick="menuClick(this);return false">Добавить мастера</a></li>
        <li><a id="SearchMaster" href="/nojs.php" onclick="menuClick(this);return false">Поиск мастера</a></li>
        <li><a id="ViewPayment" href="/nojs.php" onclick="menuClick(this);return false">Поиск платежа</a></li>
        <li><a id="ViewPayment" href="/nojs.php" onclick="menuClick(this);return false">Импорт\Экспорт</a></li>
    </ul>
    <div id="form"></div>
    <div id="content"></div>
    <div id="imp_result"></div>
    <input type="button" onClick="formImport()" value="Импорт"></input>
</body>
</html>

