<?php
define('ROOT', '../modules/');
require_once ROOT . 'constants.php';
require_once ROOT . 'database.class.php';
$oDB = new Database($aDatabase['host'], $aDatabase['user'], $aDatabase['pwd'], $aDatabase['name']);

$sAmount = $oDB->selectField('
           SELECT `amount`
           FROM `materials_out`
           WHERE `id` = "' . $_POST['id'] . '"
');

if($sAmount == $_POST['amount']){
  $sCheck = $oDB->query('
      UPDATE `materials_out`
      SET `status` = "1",
	      `amount` = "0"
      WHERE `id` = "' . $_POST['id'] . '"
  ');
}
else {
	if( ($sAmount > $_POST['amount']) && ($_POST['amount'] > 0) )
	    $sCheck = $oDB->query('
                  UPDATE `materials_out`
                  SET `amount` = "' . ($sAmount - $_POST['amount']) . '"
                  WHERE `id` = "' . $_POST['id'] . '"
                  ');
    else {
        echo "указано неверное количество.";
        exit();
    } 
}
if($sCheck != 0){
    echo "принято.";
}
else{
    echo "что-то прошло не так.\nНе могу найти заготовку №" . $_POST['id'] . " в списке выданных.";
}
?>
