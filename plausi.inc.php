<?php
/**
* Klasse mit Testmethoden, ob die offensichtlichen * Regeln für das Netzwerk erfüllt sind
*/
class Plausi {
  public function namentest($wert) {
    if (preg_match("/^\w{2,30}$/", $wert)) {
        return 0;
    } else {
        echo 'Fehler beim Namentest<br>';
        return 1; 
    }
  }

  public function emailtest($wert) {
    $fehler = 0;
    // Test notwendige E-Mail-Struktur
    
    if (!preg_match("/^[0-9a-z]\w+@\w+\.[0-9a-z]{2,4}$/i", $wert)) {
        $fehler++; 
    }
     
    // nichtalphanumerische Zeichen – außer dem Zeichen @ 
    if (preg_match("/\W/", $wert, $ergarray)) {
        if ($ergarray[0] != "@") {
          $fehler++;
        }
    }
    
    return $fehler;
  }

  public function nutzerdatentest($wert) {
    $fehler = 0;
    if (!preg_match("/^\w{8,20}$/", $wert)) {
      $fehler++;
      echo 'Fehler beim Datrentest - Länge<br>';
    }
    // Keine Zahl
    if (!preg_match("/\d/", $wert)) {
      echo 'Fehler beim Datentest - Keine Zahl - '.$wert.'<br>';
        $fehler++; }
    // Kein Großbuchstabe
    if (!preg_match("/[A-Z]/", $wert)) {
      echo 'Fehler beim Datrentest - kein Großbuchstabe<br>';
        $fehler++; }
    // Kein Kleinbuchstabe
    if (!preg_match("/[a-z]/", $wert)) {
      echo 'Fehler beim Datrentest - kein Kleinbuchstabe<br>';
        $fehler++; }
    return $fehler;
  } 
}
?>