<?php
session_start();
class Bemerkungen {
    function bemerk_db($bild) {
        @include("db.inc.php");
        $s1 = "<table class='rezepttab'><tr>
        <td class=''detailbildcontainer'>
        <img class='detailbild' src='images/$bild'>
        </td><td class='vorschauinfos'>";

        if($stmt = $pdo->prepare("SELECT zusatzinfos FROM fragen WHERE bild='$bild'")) {
            $stmt->execute();
            while($row = $stmt -> fetch()) {
                if($row['zusatzinfos'] == "") {
                    $s2 = "Es sind keine zusätzlichen Informationen zu dem Bild in der Datenbank hinterlegt.</td></tr></table>";
                } else {
                    $s2 = $row['zusatzinfos']."</td></tr></table>";
                }
            }
        }
        $s3 = "<form action='index.php' id='rezeptformular'>
        <h3>Ihr Vorschlag für ein Rezept</h3>
        <textarea name='rezeptvorschlag' cols='105' rows='4' id='rezeptvorschlag'></textarea>
        <input type='hidden' name='bild' value=$bild>
        <br><input class='hlink' type='submit' value='Vorschlag abgeben'></form>";
        echo $s1.$s2.$s3;
    }
}
if(isset($_GET['details'])) {
    $obj = new Bemerkungen();
    $obj->bemerk_db($_GET['details']);
}






?>