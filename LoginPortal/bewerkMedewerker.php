<?php
session_start ();
$user = $_SESSION ['user'];

include ("../DatabaseFunctions.php");
$pdo = connectToServer ( "mysql:host=178.62.201.206;port=3306", "omega", "usbw" );
selectDatabase ( $pdo, "omega" );

if (isset ( $_SESSION ['user'] )) {
	if (checkUserLevel ( $pdo, $user ) == 1) {
	} else {
		header ( 'Location: login.php' );
	}
} else {
	header ( 'Location: login.php' );
}

if (isset ( $_GET ['verwijder'] )) {
	$id = $_GET ['verwijder'];
	// verwijder functie
	// id = meegegeven medewerkernummer
	$query = $pdo->prepare ( "SELECT Naam FROM medewerker WHERE medewerkernummer = ?" );
	$query->execute ( array ($id ) );
	$user2 = '';
	while ( $row = $query->fetch () ) {
		$user2 = $row ['Naam'];
	}
	if (checkUserLevel ( $pdo, $user2 ) != 1) {
		
		$delfunction = "DELETE FROM login WHERE medewerkernummer = ?; DELETE FROM medewerker WHERE Medewerkernummer = ?";
		$query = $pdo->prepare ( $delfunction );
		$query->execute ( array ($id,$id ) );
		
		// controle verwijdering en een reactie als het gelukt is
		if ($query->rowCount () > 0) {
			echo "Gebruiker $user2 verwijderd.";
		} else {
			echo 'Gebruiker kon niet worden verwijderd';
		}
	} else {
		echo 'Deze gebruiker kan niet worden verwijderd!';
	}
} elseif (isset ( $_GET ['wijzig'] )) {
	// Do stuff
}

?>

