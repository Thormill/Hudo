<?php
define('ROOT', '../modules/');
require_once ROOT . 'constants.php';
require_once ROOT . 'database.class.php';
if (!isset ($_SESSION['username'])) session_start(); 
session_destroy();
