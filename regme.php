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
    <div class="registration">
		<p><a href = "index.php">На главную</a></p>
		<form>
		    <label>Логин:</label><input type="text" id="userlogin" />
		    <label>Пароль:</label><input type="password" id="userpass" />
		    <label>Подпись:</label><input type="text" id="userinfo" />
		    <input type="button" value="зарегистрировать пользователя" onClick="Register();" />
		</form>
    </div>
    <div id="output"></div>
</body>	
</html>
