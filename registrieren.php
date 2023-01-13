<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <title>Image2Food –
      Sag mir, was ich daraus kochen kann – Registrierung 
      </title>
<meta name="viewport" content= "width=device-width, initial-scale=1.0">
  </head>
  <body>
    <div id="nav">
      <?php
      require("nav.php");
      require ("plausi.inc.php");
      ?>
 </div>
    <div id="content">
      <h1>Registrierung</h1>
      <?php
      require ("registrieren.inc.php");
      /**
      * Image2Food
      * Das soziale, multimediale Netzwerk für Kochideen * Die Registrierungsseite
      */
      class Registrierung {
        /**
         * Registrierungsmethode
         * – Erst Eingaben des Anwenders plausibilisieren
         * – Dann in der MySQL-Datenbank eintragen, wenn die Plausibilisierung keine Fehler ergeben hat
        */
        public function registrieren() {
          if ($this -> plausibilisieren()) {
            $this -> eintragen_db();
          }
        }
        /**
         * Plausibilisierungsmethode
         * Testet die einzelnen Eingabefelder des
         * Registrierungsformulars gegenüber
         * – den Notwendigkeiten in der MySQL-Datenbank und
         * – weiteren Anforderungen, die die Logik
         * des Netzwerks fordert.
         * Die Eingaben stehen im globalen Array $_POST
         * zur Verfügung
         * @return true, wenn die Plausibilisierung
         * keine Fehler ergab – sonst false
         */
        private function plausibilisieren() {
          // Fehlervariable
          $anmelden = 0;
          $p = new Plausi();
          $anmelden += $p -> namentest($_POST['name']);
          $anmelden += $p -> namentest($_POST['vorname']); 
          $anmelden += $p -> emailtest($_POST['email']);
          $anmelden += $p -> nutzerdatentest($_POST['userid']); 
          $anmelden += $p -> nutzerdatentest($_POST['pw']);
          // Kritische Zeichen auf der freien Eingabe
          // der Zusatzinfos eliminieren
          $_POST['zusatzinfos'] =
            preg_replace("/[<|>|$|%|&|§]/", "#",
              $_POST['zusatzinfos']);
          // Testausgaben für den derzeitigen Stand
          // des Projekts
          echo "Die Eingaben: <hr>";
          print_r($_POST);
          echo "<br>Fehleranzahl: " . $anmelden . "<hr>";
          if ($anmelden == 0) return true;
          else return false;
        }
        /**
         * Eintragen der Anmeldedaten in die Datenbank
         * Die Eingaben stehen im globalen Array $_POST
         * zur Verfügung
         */
        private function eintragen_db() {
          require("db.inc.php");
          try {
            $stmt = $pdo->prepare("INSERT INTO mitglieder (name, vorname, email, zusatzinfos, rolle, userid, pw) VALUES (:name, :vorname, :email, :zusatzinfos, :rolle, :userid, :pw)");
            $stmt->execute(array(
              ':name' => $_POST["name"],
              ':vorname' => $_POST["vorname"],
              ':email' => $_POST["email"],
              ':zusatzinfos' => $_POST["zusatzinfos"],
              ':rolle' => "Mitglied",
              ':userid' => $_POST["userid"],
              ':pw' => md5($_POST["pw"])
            ));

            $_SESSION["name"] = $_POST["userid"];
            $_SESSION["login"] = "false";
            $dat = "index.php";
          } catch (PDOException $e) {
            $dat = "regfehler.php";
          }
          header("Location: $dat");
          
        }
        
      }

      $regobj = new Registrierung();
      if (sizeof($_POST) > 0) {
        $regobj -> registrieren();
      }
      ?>
    </div>
  </body>
</html>