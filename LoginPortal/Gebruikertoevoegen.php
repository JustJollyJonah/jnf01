<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" href="StylePortal.css">
		<link rel="stylesheet" href="productliststyle.css">
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
    </div>
<?php
//Sessie, database connectie en userlevelcheck
session_start();
$user = $_SESSION['user'];

include ("../DatabaseFunctions.php");
include ("../LoginPortal/CustomEncryption.php");
$db = connectToServer( "mysql:host=178.62.201.206;port=3306", "omega", "usbw" );
selectDatabase ( $db, "omega" );

if(isset($_SESSION['user'])){
	if(checkUserLevel($db, $user) == 1){
			
	}else{
		header('Location: login.php');
	}
}else{
	header('Location: login.php');
}

// SQL die uitgevoerd word als de form hieronder ingevuld wordt.
if(isset($_POST['MedewerkerSubmit']))
{
	$stmt = $db ->prepare ( "INSERT INTO medewerker (Naam, Achternaam, Adres, Woonplaats, Postcode, Medewerkernummer, Locatienummer, Actief, Functie) VALUES (?,?,?,?,?,?,?,?,?)");
	$stmt->execute (array($_POST ['Naam'], $_POST ['Achternaam'], $_POST ['Adres'], $_POST ['Woonplaats'], $_POST ['Postcode'], $_POST['Medewerkernummer'], $_POST ['Locatienummer'], $_POST ['Actief'], $_POST ['Functie']));
	header('Location: \LoginPortal\Gebruikersbeheer.php');
}
?>
	<!-- Tabel voor de toevoeging van nieuwe gebruikers  -->
    	
    <!-- $_SERVER['PHP_SELF'] zorgt er voor dat als je ooit de naam veranderd van deze file hij alsnog werkt. -->
    	<form method="POST">
		<table class="tabelinfo">
		 <h2 class="headtext">Medewerker toevoegen</h2>
			<tr>
				<td>Voornaam:</td>
				<td><input type="text" value="" name="Naam" placeholder="Naam van medewerker" required /></td>
			</tr>
			<tr>
				<td>Achternaam:</td>
				<td><input type="text" placeholder="achternaam" name="Achternaam" required /></td>
			</tr>
			<tr>
				<td>Adres:</td>
				<td><input type="text" placeholder="adres" name="Adres"></td>
			</tr>
			<tr>
				<td>Woonplaats:</td>
				<td><input type="text" placeholder="woonplaats" name="Woonplaats"></td>
			</tr>
			<tr>
				<td>Postcode:</td>
				<td><input type="text" placeholder="postcode" name="Postcode"></td>
			</tr>
			<tr>
				<td>Medewerkernummer:</td>
				<td><input type="text" name= "Medewerkernummer"></td>
			<tr>
				<td>Locatienummer:</td>
				<td>
				<select name=Locatienummer>
				<?php 
					$query = $db->prepare("SELECT * FROM locatie");
					$query->execute();
					while($row = $query->fetch()){
						echo "<option>" . $row['Locatienummer'] . "</option>";
					}
				?>
				</select>
				</td>
			</tr>
			<tr>
				<td>Functie: </td>
				<td>
				<select name=Functie>
				<?php 
					$query = $db->prepare("SELECT * FROM functie");
					$query->execute();
					while($row = $query->fetch()){
						echo "<option>" . $row['Functie'] . "</option>";
					}
					
				?>
				</select>
				</td>
			</tr>
			<tr>
				<td>Actief:</td>
				<td><input type="radio" name="Actief" value="1"> Ja 
				<input type="radio" name="Actief" value="0"> Nee</td>
			</tr>	
				<td></td>
				<td><input type="submit" name="MedewerkerSubmit" value="Verzend"></td>
			</tr>
		</table>
	</form>
	</body>
	</html>
