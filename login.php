 <!DOCTYPE html>
 <html lang="de">
   <head>
     <meta charset="utf-8">
     <title>Image2Food –
       Sag mir, was ich daraus kochen kann – Login </title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0"> </head>
   <body>
     <div id="nav">
       <?php
       require("nav.php");
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

        }

        public function _login() {
          if ($this -> plausibilisieren()) {
            $this -> anmelden_db();
          }
        }

        private function plausibilisieren() {
          // Fehlervariable
          $anmelden = 0;
          $p = new Plausi();
          $anmelden += $p -> nutzerdatentest($_POST['userid']); 
          $anmelden += $p -> nutzerdatentest($_POST['pw']);
          
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
        $anmeldeObjekt -> _login();
      }
       ?>
     </div>
   </body>
</html>