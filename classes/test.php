<?php

//define('ROOT', '../../');

require_once 'database.class.php';
require_once '../config/constants.php';

$oDB = new Database($aDatabase['host'], $aDatabase['user'], $aDatabase['pwd'], $aDatabase['name']);

$type = 4;
$category = 4;
$item = 'asdasd';
$oDB->insert(
    'INSERT INTO `items`
        SET `i_id` = 3,
            `type_id` = ' . $type . ',
            `category_id` = ' . $category . ',
            `item` = "' . $item . '"'       
);
