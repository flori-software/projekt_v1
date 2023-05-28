<?php
session_start();
unset($_SESSION['captchacode']);

header('Content-Type: image/gif');
// Zeichen, die der Captchacode enthalten darf
$moeglicheZeichen = "abcdefghiklmnpqrstuvwxy123456789"."ABCDEFGHIJKLMNOPQRSTUVWXYZ";
// Anzahl der Zeichen, die das Captcha enthalten soll
$anzahlZeichen = 4;
// Captcha-Variable
$captchacode = "";
// Füllen der Captcha-Variable mit der festgelegten
// Anzahl zufälliger Zeichen
for ($i = 0; $i < $anzahlZeichen; $i++) {
    $captchacode .= substr($moeglicheZeichen, (rand() % (strlen($moeglicheZeichen))), 1);
}
// Schreiben des Captchacodes in die Session
$_SESSION['captchacode'] = $captchacode;

// Teil der eine Ausgabe erzeugt
header('Content-type: image/jpg');
$image = imagecreate(350, 130);
$farben = array();
for ($i = 0; $i < $anzahlZeichen; $i++) {
    $farben[$i] = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
}
$bgc = imagecolorallocate($image, 230, 230, 230);
imagefill($image, 0, 0, $bgc);

for ($i = 0; $i < $anzahlZeichen; $i++) {
    $file =  __DIR__."/fonts/ttf/Vera.ttf";
    $anzahl = $anzahlZeichen - 1;
    imagettftext($image, rand(20, 80), rand(-20, 60), 50 + ($i * 50), rand(80, 120), $farben[rand(0, $anzahl)], $file, $captchacode[$i]);
}
for ($i = 0; $i < $anzahlZeichen; $i++) {
    imageline($image, rand(0, 10), rand(0, 150), rand(330, 340), rand(0, 150), $farben[$i]);
}
imagejpeg($image);
imagedestroy($image);
?>