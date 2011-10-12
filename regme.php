<?php
define('ROOT', 'modules/');
require_once ROOT . 'constants.php';
require_once ROOT . 'database.class.php';
session_start();
$oDB = new Database($aDatabase['host'], $aDatabase['user'], $aDatabase['pwd'], $aDatabase['name']);

if( (!isset($_POST['userlogin'])) && (!isset($_POST['userpass'])) 
                                  && (!isset($_POST['userinfo'])) 
                                  && ($_POST['userlogin'] != '')
                                  && ($_POST['userpass'] != '')
                                  && ($_POST['userinfo'] != ''))
{
?>
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
		<form action="regme.php" method="post">
		    <label>Логин:</label><input type="text" name="userlogin" />
		    <label>Пароль:</label><input type="password" name="userpass" />
		    <label>Подпись:</label><input type="text" name="userinfo" />
		    <input type="submit" value="зарегистрировать пользователя" />
		</form>
    </div>
</body>	
</html>
<?php
}
else {
	?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Система учета счетов</title>
<link rel="shortcut icon" href="img/favicon.ico">
<link rel="stylesheet" type="text/css" href="style/Index.css" />
<script type="text/javascript" src="scripts/jquery-min.js"></script>
<script type="text/javascript" src="scripts/jquery-ui-1.8.16.js"></script>
<script type="text/javascript" src="scripts/Index.js"></script>
</head>
	<?
	$sLogin = $oDB->selectField('
	    SELECT `userinfo`
	    FROM   `users`
	    WHERE  `uname` = "' . $_POST['userlogin'] . '"
	');
	if(empty($sLogin))
	{
		$_POST['userlogin'] = '';
        $_POST['userpass'] = '';
        $_POST['userinfo'] = '';
		exit( $sLogin . ' уже зарегистрирован в системе.');
	}
	
	$iInsert = $oDB->insert('
	    INSERT INTO `users`
	    SET `uname` = "' . $_POST['userlogin'] . '",
			`upass`  = "' . md5($_POST['userpass']) . '",
			`user_info` = "' . $_POST['userinfo'] . '"
	');
    if ($iInsert != 0){
        echo "Пользователь добавлен.";
        $_POST['userlogin'] = '';
        $_POST['userpass'] = '';
        $_POST['userinfo'] = '';
	}
    else
    {
        echo "Ошибка БД: " . $oDB->getError();
        $_POST['userlogin'] = '';
        $_POST['userpass'] = '';
        $_POST['userinfo'] = '';
	}
}
