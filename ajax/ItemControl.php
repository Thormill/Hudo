<?php
define('ROOT', '../modules/');
require_once ROOT . 'constants.php';
require_once ROOT . 'database.class.php';
$oDB = new Database($aDatabase['host'], $aDatabase['user'], $aDatabase['pwd'], $aDatabase['name']);

if( (isset($_POST['Type'])) && ($_POST['Type'] != '') ){
  $sType = $oDB->selectField('
      SELECT `type_name`
          FROM `types`
          WHERE `type_name` = "' . $_POST["Type"] . '"
  ');

  if ($sType == "") {
      $tInsert = $oDB->insert('
          INSERT INTO `types`
              SET `type_name` = "' . $_POST["Type"] . '"
     ');

      if ($tInsert != 0)
          echo "Информация\r\n>> Тип добавлен\r\n";
      else
      {
          echo "Ошибка базы данных\r\n";
          echo '>> ' . $oDB->getError();
      }
  } else {
      echo "Ошибка\r\n";
      echo ">> Этот тип уже есть в БД\r\n";
  }
}
if( (isset($_POST['Category'])) && ($_POST['Category'] != '') ){
  $sCat = $oDB->selectField('
      SELECT `category_name`
          FROM `categories`
          WHERE `category_name` = "' . $_POST["Category"] . '"
  ');

  if ($sCat == "") {
      $cInsert = $oDB->insert('
          INSERT INTO `categories`
              SET `category_name` = "' . $_POST["Category"] . '"
     ');

      if ($cInsert != 0)
          echo "Информация\r\n>> Категория добавлена\r\n";
      else
      {
          echo "Ошибка базы данных\r\n";
          echo '>> ' . $oDB->getError();
      }
  } else {
      echo "Ошибка\r\n";
      echo ">> Эта категория уже есть в БД\r\n";
  }
}
if( (isset($_POST['Item'])) && ($_POST['Item'] != '') ){
  $sItem = $oDB->selectField('
      SELECT `item_name`
          FROM `items`
          WHERE `item_name` = "' . $_POST["Item"] . '"
  ');

  if ($sItem == "") {
      $iInsert = $oDB->insert('
          INSERT INTO `items`
              SET `item_name` = "' . $_POST["Item"] . '"
     ');

      if ($iInsert != 0)
          echo "Информация\r\n>> Изделие добавлено\r\n";
      else
      {
          echo "Ошибка базы данных\r\n";
          echo '>> ' . $oDB->getError();
      }
  } else {
      echo "Ошибка\r\n";
      echo ">> Это изделие уже есть в БД\r\n";
  }
}
