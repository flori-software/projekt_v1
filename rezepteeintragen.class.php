<?php
session_start();
class RezeptEintragen {
    function eintragen_db($bild, $antwort) {
        @include("db.inc.php");
        $userid = $_SESSION["name"];
        if($stmt = $pdo->prepare("SELECT id_mitglied FROM mitgliederWHERE userid='$userid'")) {
            $stmt->execute();
            while($row = $stmt->fetch()) {
                $id_antwortgeber = $row['id_mitglied'];
                break;
            }
        }

        if($stmt = $pdo->prepare("SELECT id_frage, id_mitglied FROM fragen WHERE bild='$bild'")) 
    }
}







?>