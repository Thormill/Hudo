<?php
define('ROOT', '../modules/');
require_once ROOT . 'constants.php';
require_once ROOT . 'database.class.php';
$oDB = new Database($aDatabase['host'], $aDatabase['user'], $aDatabase['pwd'], $aDatabase['name']);

//установлен тип - обновляем тип
if( ($_POST['t_id'] != 0) && ($_POST['category_name'] == '') && ($_POST['c_id'] == 0) ) 
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
if( ($_POST['t_id'] != 0) && ($_POST['category_name'] != '') && ($_POST['c_id'] == 0) ){
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
  exit();
}

if( ($_POST['t_id'] != 0) && ($_POST['c_id'] != 0) && ($_POST['i_id'] == 0) && ($_POST['item_name'] != '') ) {
    $uType = $oDB->query('
             UPDATE `types` 
             SET `type_name` = "' . $_POST['type_name'] . '"
             WHERE `t_id` = "' . $_POST['t_id'] . '"'
             );

    $uCategory = $oDB->query('
             UPDATE `categories` 
             SET    `categorie_name` = "' . $_POST['category_name'] . '"
             WHERE  `c_id` = "' . $_POST['c_id'] . '"'
             );	
	
	  $sItem = $oDB->selectField('
      SELECT `item_name`
          FROM `items`
          WHERE `item_name` = "' . $_POST['item_name'] . '"
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
  exit();
}
if( ($_POST['t_id'] != 0) && ($_POST['c_id'] != 0) && ($_POST['i_id'] != 0) ) {
//все элементы выбраны, обноляем все и вставляем цену
  if( (isset($_POST['price'])) && ($_POST['price'] != '') ){
      $uType = $oDB->query('
             UPDATE `types` 
             SET `type_name` = "' . $_POST['type_name'] . '"
             WHERE `t_id` = "' . $_POST['t_id'] . '"'
             );

      $uCategory = $oDB->query('
             UPDATE `categories` 
             SET    `categorie_name` = "' . $_POST['category_name'] . '"
             WHERE `c_id` = "' . $_POST['c_id'] . '"'
             );
      $uItem = $oDB->query('
             UPDATE `items` 
             SET    `item_name` = "' . $_POST['item_name'] . '"
             WHERE `i_id` = "' . $_POST['i_id'] . '"'
             );	
             
      $sPrice = $oDB->selectField('
          SELECT `price`
              FROM `prices`
              WHERE `item_id` = "' . $_POST['i_id'] . '"
          ');

      if ($sPrice != "") {
          $uPrice = $oDB->query('
             UPDATE `prices` 
             SET `price` = "' . $_POST['price'] . '"
             WHERE `type_id` = "' . $_POST['t_id'] . '"
             AND `category_id` = "' . $_POST['c_id'] . '"
             AND `item_id` = "' . $_POST['i_id'] . '"
             ');
          echo "цена обновлена";
	  }
	  else
	  {
		  $iPrice = $oDB->insert('
             INSERT INTO `prices` 
             SET `price` = "' . $_POST['price'] . '",
                 `type_id` = "' . $_POST['t_id'] . '",
                 `category_id` = "' . $_POST['c_id'] . '",
                 `item_id` = "' . $_POST['i_id'] . '"
             ');
           echo "цена добавлена";
	  }
  }
  exit();
}
