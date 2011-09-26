<?php
define('ROOT', '../modules/');
require_once ROOT . 'constants.php';
require_once ROOT . 'database.class.php';
$oDB = new Database($aDatabase['host'], $aDatabase['user'], $aDatabase['pwd'], $aDatabase['name']);

//установлен тип - обновляем тип
if( (isset($_POST['t_id'])) && ($_POST['t_id'] != 0) && ($_POST['category_name'] == '')) 
{
	$uType = $oDB->query('
    UPDATE `types` 
        SET `type_name` = "' . $_POST['type_name'] . '"
        WHERE `t_id` = "' . $_POST['t_id'] . '"'
    );
    if ($uType != 0)
	  echo "Информация о " . $_POST['type_name'] . " обновлена";
    else
    {
        echo "<b>Ошибка базы данных</b><br />";
        echo $oDB->getError();
    }	  
	exit();
}

//меняем тип и подвязыаем к нему категорию
if( (isset($_POST['t_id'])) && ($_POST['t_id'] != 0) && ($_POST['category_name'] != '') && ($_POST['c_id'] == 0)){
  $uType = $oDB->query('
  UPDATE `types` 
      SET `type_name` = "' . $_POST['type_name'] . '"
      WHERE `t_id` = "' . $_POST['t_id'] . '"'
  );
  
  $sCat = $oDB->selectField('
      SELECT `category_name`
          FROM `categories`
          WHERE `category_name` = "' . $_POST["category_name"] . '"
          AND `type_id` = "' . $_POST["t_id"] . '"
  ');

  if ($sCat == "") {
      $cInsert = $oDB->insert('
          INSERT INTO `categories`
              SET `category_name` = "' . $_POST["category_name"] . '",
                  `type_id` = "' . $_POST["t_id"] . '"
     ');

      if ($cInsert != 0)
          echo "Информация\r\n>> Категория добавлена\r\n";
      else{
          echo "Ошибка базы данных\r\n";
          echo '>> ' . $oDB->getError();
      }
  } 
  else{
      echo "Ошибка\r\n";
      echo ">> Эта категория уже есть в БД\r\n";
  }
}

if( ($_POST['t_id'] != 0) && ($_POST['c_id'] != 0) && ($_POST['i_id'] == 0) ){
    $uType = $oDB->query('
             UPDATE `types` 
             SET `type_name` = "' . $_POST['type_name'] . '"
             WHERE `t_id` = "' . $_POST['t_id'] . '"'
             );

    $uCategory = $oDB->query('
             UPDATE `categories` 
             SET `t_id` = "' . $_POST['t_id'] . '",
                 `categorie_name` = "' . $_POST['category_name'] . '"
             WHERE `c_id` = "' . $_POST['c_id'] . '"'
             );	
	
	  $sItem = $oDB->selectField('
      SELECT `item_name`
          FROM `items`
          WHERE `item_name` = "' . $_POST['Item'] . '"
          AND `category_id` = "' . $_POST['c_id'] . '"
  ');

  if ($sItem == "") {
      $iInsert = $oDB->insert('
          INSERT INTO `items`
              SET `item_name` = "' . $_POST['item_name'] . '",
                  `category_id` = "' . $_POST['c_id'] . '",
                  `type_id` = "' . $_POST['t_id'] . '"
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
  
  if( (isset($_POST['price'])) && ($_POST['price'] != '') ){
    //добавляем цену. 
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
