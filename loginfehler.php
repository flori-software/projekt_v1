<?php
session_start();
if(0 > version_compare(PHP_VERSION, '7')) {
    die('<h1>Für diese Anwendung ist mindestens PHP 7 notwendig</h1>');
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title></title>
</head>
</html>