<?php
define('ROOT', '../modules/');
require_once ROOT . 'constants.php';
require_once ROOT . 'database.class.php';
//session_start();
$oDB = new Database($aDatabase['host'], $aDatabase['user'], $aDatabase['pwd'], $aDatabase['name']);

if( ( (!isset($_POST['userlogin'])) && (!isset($_POST['userpass'])) && (!isset($_POST['userinfo'])) )
   || ( ($_POST['userlogin'] == '') && ($_POST['userpass'] == '')   && ($_POST['userinfo'] == '')) )
{
	exit('Введите данные');
}
else {

	$sLogin = $oDB->selectField('
	    SELECT `user_info`
	    FROM   `users`
	    WHERE  `uname` = "' . $_POST['userlogin'] . '"
	');
	if(!empty($sLogin))
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
		echo $sLogin;
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
