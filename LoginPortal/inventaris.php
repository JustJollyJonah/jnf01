<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=${encoding}">
<title>Inventaris</title>
<link type="text/css" rel="stylesheet" src="bootstrap.css">
</head>
    <body>
    <?php
    //sessie start
    session_start();
    //$user = $_SESSION['user'];
    //Includes
    include('../DatabaseFunctions.php');
	//Database connectie
    $pdo = connectToServer ( "mysql:host=localhost;port=3307;", "root", "usbw" );
    selectDatabase ( $pdo, "omega" );
    
    //pagina vaststellen
    if (isset($_GET['page'])) {
    	$pagina = $_GET["page"];
    } else {
    	$pagina = 1;
    }
    
    //pagina verdeling
    $query = $pdo->prepare("SELECT * FROM inventaris");
    $query->execute();
    $aantal = $query->rowCount();
    $aantalPerPagina = 3;
    $totaalPagina = ceil($aantal/$aantalPerPagina);
    
    ///File upload script

     
    
   
    
    //Hier komt alles vanuit een post te staan
    if (isset($_POST['plus'])){	//Plus knop
    	$stmt = $pdo->prepare("UPDATE inventaris SET Beschikbaarheid = Beschikbaarheid + 1 WHERE Productnummer=?");
    	$stmt->execute(array($_POST["productnummer"]));
    } else if (isset($_POST['min'])){ //Min knop
    	$stmt = $pdo->prepare("UPDATE inventaris SET Beschikbaarheid = Beschikbaarheid - 1 WHERE Productnummer=?");
    	$stmt->execute(array($_POST["productnummer"]));
    } else if (isset($_POST['verwijder'])) { //Verwijder knop, echter verwijderen we hem niet, we zetten hem op niet actief
    	$stmt = $pdo->prepare("UPDATE inventaris SET actief = 0 WHERE Productnummer=?");
    	$stmt->execute(array($_POST["productnummer"])); 
    } else if (isset($_POST['toevoegen'])) { //Voeg toe knop, hier komt een heel formulier te voorschijn
    	?>
    	
    	<h2>Product toevoegen</h2>
    	<table>
    		<form action="inventaris.php" method="post" enctype="multipart/form-data">
	    	<tr><td>Productnaam:</td><td> <input type="text" value="Naam van product" name="name"></td></tr>
	    	<tr><td>Product beschrijving </td>
	    	<tr><td colspan="2"><textarea rows="3" cols="50" name="beschrijving"></textarea> </td></tr>
	    	<tr><td>Aantal: </td><td><input type="text" name="aantal" value="voer aantal in"></td></tr>
	    	<tr><td>Actief: </td><td><input type="radio" name="actief" value="1"> Ja
	    	<input type="radio" name="actief" value="0"> Nee </td></tr>
	    	<tr><td>Foto bestand </td><td><input type="file" name="fileToUpload"></td></tr>
	    	<tr><td>Webshop url</td><td><input type="text" name="webshopurl" value="voer webshop url in"></td></tr>
	    	<tr><td><input type="submit" name="voegtoe" value="product toevoegen"></td>
	    		<td><input type="submit" name="terug" value="Terug naar overzicht"></td></tr>
	    	</form>
	    </table>
	    <form action="inventaris.php" method="post">
	    </form>
    	<?php 
    } else if (isset($_POST['voegtoe'])) {
    	
    	//afbeelding upload script
    	$target_dir = "uploads/";
    	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    	$uploadOk = 1;
    	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    	$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    	if($check !== false) {
    		echo "Het bestand is geen afbeelding - " . $check["mime"] . ".";
    		$uploadOk = 1;
    		$imgurl = $target_file;
    	} else {
    		echo "Het bestand is een afbeelding.";
    		$uploadOk = 0;
    	}
    	//Controleer of het bestand al bestaat
    	if (file_exists($target_file)) {
    		echo "Sorry, het bestand bestaal al op de server";
    		$uploadOk = 0;
    	}
    	//Controleer of het bestand niet te groot is
    	if ($_FILES["fileToUpload"]["size"] > 500000) {
    		echo "Sorry, het bestand is te groot.";
    		$uploadOk = 0;
    	}
    	//Controleer of het bestand de juiste type is
    	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    				echo "Sorry, alleen JPG, JPEG, PNG zijn toegestaan";
    				$uploadOk = 0;
    			}
    	//Controleert of de variable uploadOk is gezet op 0 door een fout
    	if ($uploadOk == 0) {
    		echo "Sorry, er is iets fout gegaan bij het uploaden";
    		//Als alles goed is, probeert hij het bestand up te load
    		} else if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
			} else { //ls er toch nog iets mis is, geeft hij deze error
			echo "Sorry, er is iets fouts opgetreden tijdens het uploaden.";
			}
			    	
    	//voert de database query uit
    	$stmt = $pdo->prepare("INSERT INTO inventaris (Product, Beschrijving, Actief, Beschikbaarheid, ImageURL, WebshopURL)
    	VALUES ('".$_POST['name']."','".$_POST['beschrijving']."','".$_POST['actief']."','".$_POST['aantal']."','
    			".$imgurl."','".$_POST['webshopurl']."')");
    	$stmt->execute();
    	//zet de post weer op 0
    	$_POST = '';
    } else if(isset($_POST['terug'])) {
    	$_POST = '';
    }
    
    
    if (!isset($_POST['toevoegen'])) {
    $start_from = ($pagina - 1) * $aantalPerPagina;
    $query = $pdo->prepare("SELECT * FROM inventaris LIMIT $start_from, $aantalPerPagina");
    $query->execute();
    $array = array();
    $aantalProducten = $query->rowCount() + 1;
    
    for ($i = 1; $i < $aantalProducten; $i ++) {
    	$query = $pdo->prepare("SELECT * FROM inventaris WHERE productnummer = $i + $pagina * $aantalPerPagina - $aantalPerPagina");
    	$query->execute();
    while($row = $query->fetch()){
    	$productnummer = $row['Productnummer'];
    	$actief = $row['Actief'];
    	$product = $row['Product'];
    	$beschrijving = $row['Product'];
    	$aantal = $row['Beschikbaarheid'];
    	$webshopurl = $row['WebshopURL'];
    	$imageurl = $row['ImageURL'];
    	
    	
    	print ("<img src='".$imageurl."' /> <br>");
    	print ("Productnummer: " . $productnummer . "<br>");
    	print ("Naam: ". $product . "<br>");    	
    	print ("Aantal beschikbaar: " . $aantal . "<br>"); 
    	if ($actief == 1) {
    		print ("Het product is actief op de site"); 
    	} else {
    		print ("<div class='inactief'>Het product is niet actief op de site</div>");
    	} ?>
    	<form action="inventaris.php" method="post">
    	<input type="hidden" value="<?php print ($productnummer);?>" name="productnummer">
    	<input type="submit" value="plus" name="plus">
    	<input type="submit" value="min" name="min">
    	<input type="submit" value="Verwijder" name="verwijder">
    	</form>
    	<?php 
    }
    }
    	print ("<br>");
    } 


     if (!isset($_POST['toevoegen'])) {
     echo ("<a href=inventaris.php?page=1> |< </a>");
     $lastpage = $pagina - 1;
     echo ("<a href=inventaris.php?page=$lastpage> < </a>");
    
     for ($i = 1; $i < $totaalPagina + 1; $i++) {
     	echo ("<a href=inventaris.php?page=$i>" . $i . "</a>");
     }
     
     $nextpage = $pagina + 1;
     echo ("<a href=inventaris.php?page=$nextpage> > </a>");
     echo ("<a href=inventaris.php?page=$totaalPagina> >| </a>");
	
	
	 ?>
	
    <form action="inventaris.php" method="post">
    <input type="submit" value="Voeg een product toe" name="toevoegen">
    </form>  
	<?php 			 } ?>
    </body>
</html>