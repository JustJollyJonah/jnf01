<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" href="StylePortal.css">
		<link rel="stylesheet" href="productlistStyle.css">
	</head>
	<body>
	<div class="banner">
    	<a href="../bezoekerssite/index.php"><img src="../../bezoekerssite/img/dynamiek_logo.png" alt="Dynamiek Logo"></a>
    	<h1>Dynamiek Ateliers Login Portaal</h1>
    	<div class=nav>
    		<div class=button><a href=inventaris.php>Voorraad</a></div>
    		<div class=button><a href=CMS.php>CMS</a></div>
    		<div class=button><a href=gebruikersbeheer.php>Gebruikersbeheer</a></div>
    	</div>
    	<div class="LoggedInUser"><?php 
    		session_start();
    		$user = $_SESSION['user'];
    		print("<td>".$user."</td>");
    		?>
    		<a href="login.php" class=logoutbutton>Log uit</a>
    	</div>
    </div>
<?php

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


</body>
</html>
