<!DOCTYPE html>
<html>
<head>
<title>Vorschau</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="lib/css/stil.css">
</head>
<body>
<h1>Vorschau</h1>
<?php
class Thumb {
    public function thumbnail_erstellen() {
        $bv = "images";
        $vb = "thumb";
        $verzeichnis = opendir($bv);
        $bilder = array();
        while (($datei = readdir($verzeichnis)) !== false) {
            if ((preg_match("/\.jpe?g$/i", $datei)) || (preg_match("/\.png$/i", $datei))) {
                $bilder[] = $datei;
            }
        }
        closedir($verzeichnis);
        $verzeichnis = opendir($vb);

        // Löschen alter Vorschaubilder
        while (($datei = readdir($verzeichnis)) !== false) {
            if ($datei != "." AND $datei != "..") {
                @unlink("$vb/$datei");
            }
        }
        closedir($verzeichnis);

        // Speichern neuer Vorschuabilder
        foreach($bilder as $bild) {
            // Je nach Dateiart muss die richtige Funktion gewählt werden
            if (preg_match("/\.png$/i", $bild)) {
                $b = imagecreatefrompng("$bv/$bild");
            } else {
                $b = imagecreatefromjpeg("$bv/$bild");
            }
            $originalbreite = imagesx($b);
            $originalhoehe = imagesy($b);
            $neuebreite = 120;
            $neuehoehe = floor($originalhoehe * ($neuebreite / $originalbreite));
            $neuesbild = imagecreatetruecolor($neuebreite, $neuehoehe);
            imagecopyresampled($neuesbild, $b, 0, 0, 0, 0, $neuebreite, $neuehoehe, $originalbreite, $originalhoehe);
            imagejpeg($neuesbild, "$vb/$bild");
            imagedestroy($neuesbild);
        }
    }

    public function thumbnail_anzeigen() {
        $bv = "thumb";
        $verzeichnis = opendir($bv);
        while (($datei = readdir($verzeichnis)) !== false) {
            if (preg_match("/\.jpe?g$/i", $datei)) {
                echo "<a href=''><img src='$bv/$datei' alt='Vorschaubild'></a> ";
            }
        }
        closedir($verzeichnis);
    }
}

$obj = new Thumb();
$obj -> thumbnail_erstellen();
$obj -> thumbnail_anzeigen();
?>
</body>
</html>