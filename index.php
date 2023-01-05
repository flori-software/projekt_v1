<?php
session_start();
setcookie(name: "Image2Food", value: time(), expires_or_options: time()+10368000);
if (0 > version_compare(PHP_VERSION, '7')) {
die('<h1>Für diese Anwendung ' . 'ist mindestens PHP 7
   notwendig</h1>');
 }
 ?>
 <!DOCTYPE html>
 <html lang="de">
   <head>
     <meta charset="utf-8">
     <title>Image2Food –
Sag mir, was ich daraus kochen kann – Index </title> <meta name="viewport" content=
"width=device-width, initial-scale=1.0">
   </head>
   <body>
     <div id="nav">
<?php
if(isset($_SESSION["login"]) && ($_SESSION["login"] == "true")) {
  require("navmitglieder.php");
} else {
  require("nav.php");
}

?> 
</div>
     <div id="content">
       <h1>Image2Food –
       Sag mir, was ich daraus kochen kann</h1>
       <h2>Das soziale, multimediale Netzwerk
       für Kochideen</h2>
<?php
class Index {
  function besucher() {
    
    if(isset($_SESSION["name"]) && $_SESSION["login"] == true) {
      $text = "Herzlich WIllkommen ".$_SESSION["name"].", schön, dass Sie wieder da sind!";
    } else {
      $text = "Willkommen auf unserer Website. Schauen Sie sich um. Sie können sich hier registrieren und dann in einem geschlossenem Mitgliederbereich anmelden.";
    }
    /*else if() {

    } else if() {

    } 
    */
    echo "<div id='indextext'>".$text."</div>";
  }
}
$obj = new Index();
$obj->besucher();
?>
  </div>
</body>
</html>