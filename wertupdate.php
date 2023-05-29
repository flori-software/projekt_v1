<?php
class WertUpdate {
    public function __construct($feld, $id_mitglied) {
        @include("db.inc.php");
        // Lesen des aktuellen Werts
        $sql1 = "SELECT $feld FROM mitglieder WHERE id_mitglied = $id_mitglied";
        if($stmt = $pdo->prepare($sql1)) {
            $stmt->execute();
            while($row = $stmt->fetch()) {
                $wert = $row[$feld];
            }
        }

        // Erhöhen des Werts
        $wert += 1;
        $sql2 = "UPDATE mitglieder SET $feld = $wert WHERE id_mitglied = $id_mitglied";
        if($stmt = $pdo->prepare($sql2)) {
            $stmt->execute();
        }
    }

}







?>