<?php
$path = "../files/export.xlsx";

if ($fd = fopen ($path, "r")) {
    $fsize = filesize($path);
    $path_parts = pathinfo($path);
    header("Content-type: application/xlsx");
    header("Content-Disposition: attachment; filename='export.xlsx'");
    header("Content-length: $fsize");
    header("Cache-control: private");
    while(!feof($fd)) {
        $buffer = fread($fd, 2048);
        echo $buffer;
    }
}
fclose ($fd);
exit;
?>


