<?php
//Sessie, database connectie en userlevelcheck
session_start();
$user = $_SESSION['user'];

include ("../DatabaseFunctions.php");
$pdo = connectToServer( "mysql:host=localhost;port=3307", "root", "usbw" );
selectDatabase ( $pdo, "omega" );

if(isset($_SESSION['user'])){
	if(checkUserLevel($pdo, $user) == 1){
			
	}else{
		header('Location: login.php');
	}
}else{
	header('Location: login.php');
}
// SQL die uitgevoerd word als de form hieronder ingevuld wordt.
if(isset($_POST['MedewerkerSubmit']) && $_POST['MedewerkerSubmit'] == 'Verzend')
{
	echo 'het is verzonden';
	$stmt = $pdo ->prepare ( "INSERT INTO Medewerker (Medewerkernummer, Naam, Achternaam, Adres, Woonplaats, Postcode, Locatienummer, Actief, Functie) VALUES (?,?,?,?,?,?,?,?,?)");
	$stmt->execute (array($_POST ['Medewerkernummer'], $_POST ['Naam'], $_POST ['Achternaam'], $_POST ['Adres'], $_POST ['Woonplaats'], $_POST ['Postcode'], $_POST ['Locatienummer'], $_POST ['Actief'], $_POST ['Functie']));
	
	$stmt = $pdo ->prepare ( "INSERT INTO login (Gebruikersnaam, Wachtwoord, Medewerkernummer, Functie) VALUES (?,?,?,?)");
	$stmt-> execute (array($_POST ['Gebruikersnaam'], $_POST ['Wachtwoord'], $_POST ['Medewerkernummer'], $_POST ['Functie']));
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
</head>
<body>
	<!-- Tabel voor de toevoeging van nieuwe gebruikers  -->
    	<h2>Medewerker toevoegen</h2>
    <!-- $_SERVER['PHP_SELF'] zorgt er voor dat als je ooit de naam veranderd van deze file hij alsnog werkt. -->
    	<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
		<table>
			<tr>
				<td>Voornaam:</td>
				<td><input type="text" value="" name="Naam" placeholder="Naam van medewerker" required /></td>
			</tr>
			<tr>
				<td>Achternaam:</td>
				<td><input type="text" value="Achternaam van medewerker" name="Achternaam" required /></td>
			</tr>
			<tr>
				<td>Adres:</td>
				<td><input type="text" value="adres" name="Adres"></td>
			</tr>
			<tr>
				<td>Woonplaats:</td>
				<td><input type="text" name="Woonplaats"></td>
			</tr>
			<tr>
				<td>Postcode:</td>
				<td><input type:"text" name="Postcode"></td>
			</tr>
			<tr>
				<td>Locatienummer:</td>
				<td><input type:"number" name="Locatienummer" required></td>
			</tr>
			<tr>
				<td>Medewerkernummer:</td>
				<td><input type:"text" name="Medewerkernummer" required></td>
			</tr>
				<td>Functie:</td>
				<td><input type:"number" name="Functie"></td>
			</tr>
			<tr>
				<td>Actief:</td>
				<td><input type="radio" name="Actief" value="1"> Ja 
				<input type="radio" name="Actief" value="0"> Nee</td>
			</tr>
			<tr>
				<td>"."</td>
				<td>"."</td>
			</tr>
			<tr>	
				<td>Gebruikersnaam:</td>
				<td><input type:"text" name="Gebruikersnaam" required></td>
			</tr>
			<tr>
				<td>Wachtwoord:</td>
				<td><input type:"text" name="Wachtwoord" required></td>
			</tr>		
			<td><input type="submit" name="MedewerkerSubmit" value="Verzend"></td>
			</tr>
		</table>
	</form>
	</body>
	</html>