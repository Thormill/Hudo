<?php
$uploaddir = '../files/';
if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $uploaddir . 
	$_FILES['uploadfile']['name'])) {
    print "File is valid, and was successfully uploaded.";
} else {
    print "There some errors!";
	phpinfo();
}
?>