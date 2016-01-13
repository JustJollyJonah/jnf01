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
$query = $db -> prepare ("SELECT * FROM medewerker");
$query->execute();
while($row = $query->fetch()){
	$medewerkernummer = $row ['Medewerkernummer'];
	$naam = $row ['Naam'];
	$achternaam = $row ['Achternaam'];
	$adres = $row ['Adres'];
	$woonplaats = $row ['Woonplaats'];
	$postcode = $row ['Postcode'];
	$functie = $row ['Functie'];
	$locatienummer = $row ['Locatienummer'];
	
}

//$selectall = $db->prepare ( "SELECT * FROM medewerker WHERE medewerkernummer = $id");
//$selectall->execute();
	if (isset ( $_GET ['wijzig'] )) {
		$id = $_GET ['wijzig'];}
		
	if(isset($_POST['MedewerkerUpdate']))
	{
		$udnaam = $_POST ['Naam'];
		$udachternaam =  $_POST ['Achternaam'];
		$udadres = $_POST ['Adres'];
		$udwoonplaats = $_POST ['Woonplaats'];
		$udpostcode = $_POST ['Postcode'];
		$udlocatienummer = $_POST ['Locatienummer'];
		$udfunctie = $_POST ['Functie'];
		
		echo 'het is verzonden';
		
		$stmt = $db ->prepare ( "UPDATE medewerker SET Naam = '$udnaam', Achternaam = '$udachternaam', Adres = '$udadres', Woonplaats = '$udwoonplaats', Postcode = '$udpostcode', Locatienummer = '$udlocatienummer', Functie = '$udfunctie' WHERE medewerkernummer = $id");
		$stmt->execute();
		

		
	}
	
?>

	<!-- Tabel voor de wijziging van gebruikers  -->
    	<h2>Medewerker wijzigen</h2>
    <!-- $_SERVER['PHP_SELF'] zorgt er voor dat als je ooit de naam veranderd van deze file hij alsnog werkt. -->
    	<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
		<table>
			<tr>
				<td>Voornaam:</td>
				<td><input type="text" value="" placeholder=<?php echo $naam?> name="Naam" required /></td>
			</tr>
			<tr>
				<td>Achternaam:</td>
				<td><input type="text" placeholder=<?php echo $achternaam?> name="Achternaam" required /></td>
			</tr>
			<tr>
				<td>Adres:</td>
				<td><input type="text" placeholder=<?php echo $adres?> name="Adres"></td>
			</tr>
			<tr>
				<td>Woonplaats:</td>
				<td><input type="text" placeholder=<?php echo $woonplaats?> name="Woonplaats"></td>
			</tr>
			<tr>
				<td>Postcode:</td>
				<td><input type="text" placeholder=<?php echo $postcode?> name="Postcode"></td>
			</tr>
			<tr>
				<td>Locatienummer:</td>
				<td><input type="number" placeholder=<?php echo $locatienummer?> name="Locatienummer" required></td>
			</tr>			
				<td>Functie: </td>
				<td><select name="Functie"><?php $query = $db->prepare("SELECT * FROM functie");
					$query->execute();
					while($row = $query->fetch()){
						echo "<option>" . $row['Functie'] . "</option>";
					} ?></select></td>
			</tr>
			<tr>		
			<td><input type="submit" name="MedewerkerUpdate" value="Verzend"></td>
			</tr>
		</table>
	</form>
</body>