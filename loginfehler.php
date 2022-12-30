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
<body>
<div id="nav">
<?php
require("nav.php");
?>
</div>
<div id="content">
<h1>Anmeldefehler</h1>
<?php
require("login.inc.php");

?>
</div>
</body>
</html>