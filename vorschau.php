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
            if ((preg_match("/\.jpe?g$/i", $datei)) || (preg_match("/\.png$/i", $datei))) {
                echo "<div class='thumb'><a class='hlink_klein' href='index.php?rezepte=$datei'>
                Rezepte anzeigen</a><br>
                <a class='hlink_nix' href='index.php?details=$datei'>
                <img class='thumb_bild' src='$bv/$datei' alt='Vorschaubild $datei'></a></div>";
            }
        }
        closedir($verzeichnis);
    }

    public function __construct() {
        echo '<h1>Vorschau der Zutaten</h1>
        <h5>Mit einem Klick auf ein Bild erhakten Sie mehr Informationen und Sie können einen Rezeptvorschlag abgeben.</h5><div id="vorschauber">';
        $this->thumbnail_erstellen();
        $this->thumbnail_anzeigen();
        echo '</div><h2>Details</h2><div id="detailbereich"></div>';
    }
}
new Thumb();
?>