<?php
$header = "index.php";

$file = $_SERVER["PHP_SELF"];
readfile($header);
readfile($file);
?>