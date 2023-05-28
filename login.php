<?php
  session_start();
?>
 <!DOCTYPE html>
 <html lang="de">
   <head>
     <meta charset="utf-8">
     <title>Image2Food –
       Sag mir, was ich daraus kochen kann – Login </title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
     <link rel="stylesheet" href="lib/css/stil.css">
  </head>
   <body>
     <div id="nav">
       <?php
       require("nav.php");
       require ("plausi.inc.php");
       ?>
     </div>
     <div id="content">
       <h1>Login</h1>
       <?php
       require("login.inc.php");
       /**
* Image2Food
* Das soziale, multimediale Netzwerk für Kochideen * Die Login-Seite
*/
       class Login {
        private function anmelden_db() {
          $vorhanden = false;
          require("db.inc.php");
          if($stmt = $pdo->prepare("SELECT userid, pw FROM mitglieder")) {
            $stmt->execute();
            while($row = $stmt->fetch()) {
              if(isset($_POST["userid"]) && $_POST["userid"] == $row['userid'] && md5($_POST["pw"]) == $row['pw']) {
                $vorhanden = true;
                break;
              }
            }
          }
          if($vorhanden) {
            $_SESSION["name"] = $_POST["userid"];
            $_SESSION["login"] = "true";
            $dat = "index.php";
          } else {
            $dat = "loginfehler.php";
          }
          header("Location: $dat");
        }

        public function _login() {
          echo 'Bin in Login<br>';
          if ($this -> plausibilisieren()) {
            echo 'Plausibilisierung erfolgreich<br>';
            $this -> anmelden_db();
          } else {
            echo 'Angaben sind nicht plausibel<br>';
          }
        }

        private function plausibilisieren() {
          // Fehlervariable
          $anmelden = 0;
          $p = new Plausi();
          $anmelden += $p -> nutzerdatentest($_POST['userid']); 
          $anmelden += $p -> nutzerdatentest($_POST['pw']);
          $anmelden += $p -> captchatest($_POST['captcha']);
          // Testausgaben für den derzeitigen Stand
          // des Projekts
          echo "Die Eingaben: <hr>";
          print_r($_POST);
          echo "<br>Fehleranzahl: " . $anmelden . "<hr>";
          if ($anmelden == 0) return true;
          else return false;
        }
       }

      $anmeldeObjekt = new Login();
      if (sizeof($_POST) > 0) {
        echo 'Anmeldung Benutzer<br>';
        $anmeldeObjekt -> _login();
      } else {
        echo 'Melden Sie sich an!';
      }
       ?>
     </div>
   </body>
</html>