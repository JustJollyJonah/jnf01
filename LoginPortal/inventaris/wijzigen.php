<?php 
include ('../../DatabaseFunctions.php');
include 'basis.php';


//Wijzigen zonder een foto verandering
if (isset($_POST['wijzig_update']) && !isset($_FILES['fileToUpload'])) {
	$query = $pdo->prepare('UPDATE inventaris SET Product = ?, Beschrijving = ?, WebshopURL = ?, Beschikbaarheid = ?, Eigenschap = ? WHERE productnummer = ?');
	$query->execute(array($_POST['product'], $_POST['beschrijving'], $_POST['webshopurl'], $_POST['beschikbaarheid'], $_POST['eigenschap'], $_POST['productnummer']));
	header('location:../inventaris.php');
	exit();
	
//Wijzigen met een foto verandering
} else if (isset($_POST['wijzig_update']) && isset($_FILES['fileToUpload'])) {
	
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
		$query = $pdo->prepare('UPDATE inventaris SET Product = ?, Beschrijving = ?, WebshopURL = ?, Beschikbaarheid = ?, Eigenschap = ?, ImageURL = ? WHERE productnummer = ?');
		$query->execute(array($_POST['product'], $_POST['beschrijving'], $_POST['webshopurl'], $_POST['beschikbaarheid'], $_POST['eigenschap'], $imageurl, $_POST['productnummer']));
		// Terug naar het overzicht
		header('location:../inventaris.php');
		exit();
	} else { // ls er toch nog iets mis is, geeft hij deze error
		echo "Sorry, er is iets fouts opgetreden tijdens het uploaden. <br>";
		print 	('
						<form action="wijzigen.php" method="post">
						<input type="submit" value="klik hier om terug te gaan" name="toevoegen">
						</form>
					') ;
	}
	
	
	
} else if (isset ($_POST ['wijzigen'])) {
					$query = $pdo->prepare ("SELECT * FROM inventaris WHERE productnummer = ?");
					$query->execute (array($_POST['productnummer']));
					while ( $row = $query->fetch () ) {
						$productnummer = $row ['Productnummer'];
						$actief = $row ['Actief'];
						$product = $row ['Product'];
						$beschrijving = $row ['Beschrijving'];
						$aantal = $row ['Beschikbaarheid'];
						$webshopurl = $row ['WebshopURL'];
						$imageurl = $row ['ImageURL'];
						$eigenschap = $row ['Eigenschap'];
						
						print ("<img width='100px' height='auto' src='" . $imageurl . "' /> <br>") ; ?>
						<form action="wijzigen.php" method="post" enctype="multipart/form-data">
						<input type="hidden" value="<?php print ($productnummer); ?>" name="productnummer">
						<table>
						<tr><td colspan="2"><input type="file" name="fileToUpload"></td></tr>
						<tr><td>Product naam: </td><td><input type="text" name="product" value="<?php print ($product); ?>"></td></tr>
						<tr><td>Beschrijving:</td><td><textarea rows="3" cols="20" name="beschrijving">
						<?php print ($beschrijving);?>
						</textarea></td></tr>
						<?php 
						if ($actief == 1) {
							print ('<tr><td>Actief:</td><td><input type="radio" name="actief" value="1" checked> Ja
									<input type="radio" name="actief" value="0"> Nee </td></tr>');
						} else {
							print ('<tr><td>Actief:<td><input type="radio" name="actief" value="1"> Ja
									<input type="radio" name="actief" value="0" checked> Nee </td></tr>');
						}
						?>
						<tr><td>Webshop URL: </td><td><input type="text" name="webshopurl" value="<?php print ($webshopurl); ?>"></td></tr>
						<tr><td>Aantal: </td><td><input type="text" name="beschikbaarheid" value="<?php print ($aantal); ?>"><br></td>
						<tr><td>Eigenschap: </td><td><input type="text" name="eigenschap" value="<?php print ($eigenschap); ?>"><br></td>
						<tr><td><input type="submit" name="wijzig_update" value="Gegevens veranderen"></td>
						
						</form>
						<form action="../inventaris.php" method="post">
						<td><input type="submit" name="terug" value="Terug naar overzicht" required></td></tr>
						</form>
						</table>
						<?php 
					}
				}
?>