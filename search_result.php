<?php
$Buch_info=array ();
$search_term = $_POST["search"];

$accountname="G16";   // Hier Ihre Gruppe mit grossem G einsetzen !!!
 
$password = "mu19man";   // Hier Ihr Passwort einsetzen !!

$dbname = "g16";   // Hier Ihre Gruppe mit kleinem g einsetzen !
 
//require("accountdata_g00.php"); // setzt password 

$db_link = mysqli_connect ("localhost", $accountname , $password , $dbname );

// if($db_link->connect_error)  geht nicht mehr in MySQL 10 !!!

if ( ! $db_link ) {
  exit('Could not connect - check you account data !');
} 

$sql = "SELECT * FROM buecher WHERE Autorname LIKE '%".$search_term."%' OR Produktitel LIKE '%".$search_term."%' ";
 
$db_erg = mysqli_query( $db_link, $sql );
if ( ! $db_erg )
{
  die('Ungültige Abfrage: ' . mysqli_error());
}

$index = 0;
while ($row = $db_erg->fetch_array(MYSQLI_ASSOC)) {
	
	$Buch_info[$index] = $row;
	$index++;
}
$myJSON = json_encode($Buch_info);

echo $myJSON;

?>