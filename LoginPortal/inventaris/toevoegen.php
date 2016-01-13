<!DOCTYPE html>
<html>
	<head>
		<title>Product toevoegen</title>
		<link rel=stylesheet href=../StylePortal.css>
		<link rel=stylesheet href=../productlistStyle.css>
	</head>
	<body>
	<div class="banner">
    		<a href="../bezoekerssite/index.php"><img src="../bezoekerssite/img/dynamiek_logo.png" alt="Dynamiek Logo"></a>
    		<p>Dynamiek Ateliers Login Portaal</p>
    		<div class=nav>
    			<div class=button><a href=inventaris.php>Voorraad</a></div>
    			<div class=button><a href=CMS.php>CMS</a></div>
    			<div class=button><a href=gebruikersbeheer.php>Gebruikersbeheer</a></div>
    		</div>
    		<div class="LoggedInUser"><?php 
    			session_start();
    			$user = $_SESSION['user'];
    			echo $user;
    			?><br>
    			<a href="login.php" class=logoutbutton>Log uit</a>
    		</div>
    	</div>
	<?php
	include ('../../DatabaseFunctions.php');
	include 'basis.php';

	if (isset ( $_POST ['voegtoe'] )) {
		
		// afbeelding upload script
		$target_dir = "../uploads/";
		$target_file = $target_dir . basename ( $_FILES ["fileToUpload"] ["name"] );
		$uploadOk = 1;
		$imageFileType = pathinfo ( $target_file, PATHINFO_EXTENSION );
		$check = getimagesize ( $_FILES ["fileToUpload"] ["tmp_name"] );
		if ($check !== false) {
			echo "Het bestand is een afbeelding - " . $check ["mime"] . ". <br>";
			$uploadOk = 1;
			$imgurl = "uploads/" . basename ( $_FILES ["fileToUpload"] ["name"] );
		} else {
			echo "Het bestand is geen afbeelding.";
			$uploadOk = 0;
		}
		// Controleer of het bestand al bestaat
		if (file_exists ( $target_file )) {
			echo "Sorry, het bestand bestaal al op de server";
			$uploadOk = 0;
		}
		// Controleer of het bestand niet te groot is
		if ($_FILES ["fileToUpload"] ["size"] > 5000000) {
			echo "Sorry, het bestand is te groot.";
			$uploadOk = 0;
		}
		// Controleer of het bestand de juiste type is
		if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
			echo "Sorry, alleen JPG, JPEG, PNG zijn toegestaan";
			$uploadOk = 0;
		}
		// Controleert of de variable uploadOk is gezet op 0 door een fout
		if ($uploadOk == 0) {
			echo "Sorry, er is iets fout gegaan bij het uploaden";
			print (' <form action="inventaris.php" method="post">
						<input type="submit" value="klik hier om terug te gaan" name="toevoegen">
						</form>
						') ;
			$_POST ['toevoegen'] = 1;
			// Als alles goed is, probeert hij het bestand up te load
		} else if (move_uploaded_file ( $_FILES ["fileToUpload"] ["tmp_name"], $target_file )) {
			echo "The file " . basename ( $_FILES ["fileToUpload"] ["name"] ) . " has been uploaded.";
			$stmt = $pdo->prepare ( "INSERT INTO inventaris (Product, Beschrijving, Actief, Beschikbaarheid, ImageURL, WebshopURL, Eigenschap) VALUES (?,?,?,?,?,?,?)");
			$stmt->execute (array($_POST ['name'], $_POST ['beschrijving'], $_POST ['actief'], $_POST ['aantal'], $imgurl, $_POST ['webshopurl'], $_POST ['eigenschap']));
			// Terug naar het overzicht
			header('location:../inventaris.php');
			exit();
		} else { // ls er toch nog iets mis is, geeft hij deze error
			echo "Sorry, er is iets fouts opgetreden tijdens het uploaden. <br>";
			print 	(' 	
						<form action="toevoegen.php" method="post">
						<input type="submit" value="klik hier om terug te gaan" name="toevoegen">
						</form>
					') ;
		}
	} else if (isset ( $_POST ['toevoegen'] )) { // Voeg toe knop, hier komt een heel formulier te voorschijn
	?>
    	
    <h2>Product toevoegen</h2>
	<table>
		<form action="toevoegen.php" method="post" enctype="multipart/form-data">
			<tr>
				<td class=toevoegen>Productnaam:</td>
				<td class=toevoegen><input type="text" value="Naam van product" name="name" required></td>
			</tr>
			<tr>
				<td class=toevoegen>Product beschrijving</td>
			<tr>
				<td colspan="2" class=toevoegen><textarea rows="3" cols="50" name="beschrijving" required></textarea></td>
			</tr>
			<tr>
				<td class=toevoegen>Aantal:</td>
				<td class=toevoegen_submit><input type="text" name="aantal" required></td>
			</tr>
			<tr>
				<td class=toevoegen>Eigenschap:</td>
				<td class=toevoegen_submit><input type="text" name="eigenschap" required></td>
			</tr>
			<tr>
				<td class=toevoegen>Actief:</td>
				<td class=toevoegen style="padding-left: 35px;"><input type="radio" name="actief" value="1"> Ja 
				<input type="radio" name="actief" value="0"> Nee</td>
			</tr>
			<tr>
				<td class=toevoegen>Foto bestand</td>
				<td class=toevoegen_submit style="padding-left: 35px;"><input type="file" name="fileToUpload" ></td>
			</tr>
			<tr>
				<td class=toevoegen>Webshop url</td>
				<td class=toevoegen_submit><input type="text" name="webshopurl" value="voer webshop url in" required></td>
			</tr>
			<tr>
				<td class=toevoegen><input type="submit" name="voegtoe" value="product toevoegen"></td>
		</form>
		<form action="../inventaris.php" method="post">
			<td class=toevoegen_submit><input type="submit" name="terug" value="Terug naar overzicht"></td>
			</tr>
		</form>
	</table>
	<?php 
	}
	?>
	</body>
</html>
