<?php
session_start();
$user = $_SESSION['user'];

include ("../DatabaseFunctions.php");
$pdo = connectToServer ( "mysql:host=178.62.201.206;port=3306", "omega", "usbw" );
selectDatabase ( $pdo, "omega" );

//verwijder functie
//id = meegegeven medewerkernummer
$id = $_GET['verwijder'];
// :id staat voor $id
$delfunction = "DELETE FROM medewerker WHERE Medewerkernummer = :id";
$query = $pdo->prepare ($delfunction);
$query->execute( array( ":id" => $id ) );

	
if(isset($_SESSION['user'])){
	if(checkUserLevel($pdo, $user) == 1){
			
	}else{
		header('Location: login.php');
	}
}else{
	header('Location: login.php');
}

//controle verwijdering en een reactie als het gelukt is
if(isset($_GET['verwijder'])&& is_numeric($_GET['verwijder']))
{	
	echo "Gebruiker {$_GET['verwijder']} verwijderd.";
}

?>

