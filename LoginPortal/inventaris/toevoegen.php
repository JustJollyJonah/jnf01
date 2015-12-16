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
				<td>Productnaam:</td>
				<td><input type="text" value="Naam van product" name="name" required></td>
			</tr>
			<tr>
				<td>Product beschrijving</td>
			<tr>
				<td colspan="2"><textarea rows="3" cols="50" name="beschrijving" required></textarea></td>
			</tr>
			<tr>
				<td>Aantal:</td>
				<td><input type="text" name="aantal" required></td>
			</tr>
			<tr>
				<td>Eigenschap:</td>
				<td><input type="text" name="eigenschap" required></td>
			</tr>
			<tr>
				<td>Actief:</td>
				<td><input type="radio" name="actief" value="1"> Ja 
				<input type="radio" name="actief" value="0"> Nee</td>
			</tr>
			<tr>
				<td>Foto bestand</td>
				<td><input type="file" name="fileToUpload" ></td>
			</tr>
			<tr>
				<td>Webshop url</td>
				<td><input type="text" name="webshopurl" value="voer webshop url in" required></td>
			</tr>
			<tr>
				<td><input type="submit" name="voegtoe" value="product toevoegen"></td>
		</form>
		<form action="inventaris.php" method="post">
			<td><input type="submit" name="terug" value="Terug naar overzicht"></td>
			</tr>
		</form>
	</table>
	<?php 
	}