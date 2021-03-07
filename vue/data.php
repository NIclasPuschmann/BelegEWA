  <?php

    //require("accountdata.php"); // setzt password ==> bitte $password mit Ihrem
    //PW selbst setzen !!! 

    $accountname = "G16";   // Hier Ihre Gruppe mit grossem G einsetzen !!!
    $password = "mu19man";   // Hier Ihr Passwort einsetzen !!
    $dbname = "g16";   // Hier Ihre Gruppe mit kleinem g einsetzen !

    //require("accountdata_g00.php"); // setzt password 

    $db_link = mysqli_connect("localhost", $accountname, $password, $dbname);

    // ##########################################################################
    // Neu:  Bitte UTF8 erzwingen bei der DB-Kommunikation (siehe zeilen nach // )  !!!!!
    // bei Verwendung nicht UTF8-konformer Daten (Ã¤Ã¶Ã¼ ??) generiert json_encode sonst nichts 
    // und gibt nur false statt des JSON-strings zurÃ¼ck  !!!
    // Laut PHP-Doku: https://www.php.net/manual/de/function.json-encode.php
    // value: ...  Alle Strings mÃ¼ssen in UTF-8 kodiert sein-
    //  Dank an Herrn Gailmann  fÃ¼r die Fehlersuche und - behebung
    $db_link->query("SET NAMES 'utf8'");
    $db_link->query("SET CHARACTER SET utf8");
    $db_link->query("SET SESSION collation_connection = 'utf8_unicode_ci'");
    // ##########################################################################


    $sql = "SELECT * FROM buecher";

    $db_erg = mysqli_query($db_link, $sql);
    if (!$db_erg) {
        die('Ungueltige Abfrage: ' . mysqli_error());
    }
    $dbdaten = array();   // neues Array fÃ¼r JSON-Ausgabe 

    //$showtable = false; // nur fÃ¼r Tests - Ausschalten fuer echte JSON-Generierung als Webservice !!!!

    // if ($showtable)  echo '<table border="1">';

    while ($zeile = mysqli_fetch_array($db_erg,MYSQLI_ASSOC)) {
        // if ($showtable) {
        //   echo "<tr>";
        //   echo "<td>" . $zeile['ProduktID'] . "</td>";
        //   echo "<td>" . $zeile['Produkttitel'] . "</td>";
        //   echo "<td>" . $zeile['Lagerbestand'] . "</td>";
        //   echo "</tr>";
        // }
        $dbdaten[] = $zeile; // DB-Daten zeilenweise komplett in neues Array Ã¼bertragen 
    }
	
	//$dbdaten = fetch_all(MYSQLI_ASSOC);
    //if ($showtable) echo "</table>";

    // Ausgabe der Daten als JSON 
    $dbdaten_as_json = json_encode($dbdaten);
    echo $dbdaten_as_json;
    // print_r ( $db_erg);

    // Optional : Ablage der JSON-Daten in einer Datei auf dem Server fÃ¼r Testzwecke 
    // kann deaktiviert werden 
    $datei = fopen("dbjson.txt", "w");
    $written =  fwrite($datei, $dbdaten_as_json);
    fclose($datei);

    mysqli_free_result($db_erg);
    ?>
