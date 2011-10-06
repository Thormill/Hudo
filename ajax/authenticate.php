<?php
define('ROOT', '../modules/');
require_once ROOT . 'constants.php';
require_once ROOT . 'database.class.php';
session_start();
$oDB = new Database($aDatabase['host'], $aDatabase['user'], $aDatabase['pwd'], $aDatabase['name']);

if( (!isset($_POST['username'])) || ($_POST['username'] == '') )
    exit('введите логин');
if( (!isset($_POST['userpass'])) || ($_POST['userpass'] == '') )
    exit('введите пароль');

$pass = $oDB->selectField('
        SELECT `upass`
        FROM   `users`
        WHERE `uname` = "' . $_POST['username'] . '"
');

if($pass != ''){
	if($pass == md5($_POST['userpass'])){
		$auth = $oDB->selectField('
			SELECT `user_info`
			FROM   `users`
			WHERE `uname` = "' . $_POST['username'] . '"
		');
		if($auth != ''){
			echo 1;
			$_SESSION['username'] = $auth;
		}
		else{
			exit('не смог прочитать данные о пользователе');
		}
	}
	else
		exit('Проверьте логин / пароль');
}
else 
	exit('Проверьте логин / пароль');
