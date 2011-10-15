<?php session_start(); ?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Система учета счетов</title>
    <link rel="shortcut icon" href="img/favicon.ico">
    <link rel="stylesheet" type="text/css" href="style/Index.css" />
    <script type="text/javascript" src="scripts/jquery-min.js"></script>
    <script type="text/javascript" src="scripts/jquery-ui-1.8.16.js"></script>
    <script type="text/javascript" src="scripts/Index.js"></script>
</head>

<body>
    <div id="main">
        <ul class="menu">
            <li><a id="AddPayment" href="/nojs.php" onclick="menuClick(this);return false">Добавить платеж</a></li>
            <li><a id="Search" href="/nojs.php" onclick="menuClick(this);return false">Поиск платежей</a></li>
            <li><a id="Plans" href="/nojs.php" onclick="menuClick(this);return false">Планы</a></li>
            <li><a id="Materials" href="/nojs.php" onclick="menuClick(this);return false">Заготовки</a></li>
            <li><a id="Control" href="/nojs.php" onclick="menuClick(this);return false">Управление данными</a></li>
            <li><a id="Store" href="/nojs.php" onclick="menuClick(this);return false">Склад</a></li>
            <li><a id="ImportExport" href="/nojs.php" onclick="menuClick(this);return false">Импорт/Экспорт</a></li>
        </ul>
        <div id="form"></div>
        <div id="content"></div>
    </div>
    <div id="footer">Белые Ночи © 2011</div>
    <div id="mask"></div>
    <div id="modal">
        <div id="close"><b>X</b></div>
        <div id="modal-content"></div>
    </div>
    <div id="login_screen"></div>

</body>
</html>

<?php
    if(!isset($_SESSION['username'])) {
	    print('
			<script type="text/javascript">
			    showLogin();
			</script>
	    ');
	}
	else {
	    echo 'вы вошли в систему как: ' . $_SESSION['username'] . 
	    '<br><a href="nojs.php" onClick="LogOut(); return false;">выйти</a>';
	   
	   echo '
			<script type="text/javascript">
				$("#close").click(function (e) {
				e.preventDefault();
				$("#mask, #modal").hide();
			});

			$("#mask").click(function () {
				$(this).hide();
				$("#modal").hide();
			});
			
			$(document).ready(function() {
					$("#AddPayment").click();
			});
			</script>
	   ';
	}
?>
