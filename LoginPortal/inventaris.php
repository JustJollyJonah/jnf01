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
    //Includes
    include('../DatabaseFunctions.php');
	//Database connectie
    $pdo = connectToServer ( "mysql:host=localhost;port=3307;", "root", "usbw" );
    selectDatabase ( $pdo, "omega" );
    
    //Hier komt alles vanuit een post te staan
    if (isset($_POST['plus'])){	//Plus knop
    	$stmt = $pdo->prepare("UPDATE inventaris SET aantal = aantal + 1 WHERE Productnummer=?");
    	$stmt->execute(array($_POST["productnummer"]));
    } else if (isset($_POST['min'])){ //Min knop
    	$stmt = $pdo->prepare("UPDATE inventaris SET aantal = aantal - 1 WHERE Productnummer=?");
    	$stmt->execute(array($_POST["productnummer"]));
    } else if (isset($_POST['verwijder'])) { //Verwijder knop, echter verwijderen we hem niet, we zetten hem op niet actief
    	$stmt = $pdo->prepare("UPDATE inventaris SET actief = 0 WHERE Productnummer=?");
    	$stmt->execute(array($_POST["productnummer"])); 
    } else if (isset($_POST['toevoegen'])) { //Voeg toe knop, hier komt een heel formulier te voorschijn
    	print ('
    	<form action="inventaris.php" method="post">
    	Productnaam: <input type="text" value="Naam van product" name="name"><br>
    	Actief: <input type="radio" name="actief" value="Ja"> Ja
    	<input type="radio" name="actief" value="nee"> Nee <br>
    	Product beschrijving <br><textarea rows="3" cols="50" name="beschrijving"></textarea> <br>
    	Aantal<input type="text" name="aantal" value="voer aantal in"><br>
    	Image link<input type="text" name="imgurl" value="voer image URL in"><br>
    	Webshop url<input type="text" name="webshopurl" value="voer webshop url in"><br>
    	<input type="submit" name="voegtoe" value="product toevoegen">
    	</form>
    			');
    } else if (isset($_POST['voegtoe'])) {
    	$stmt = $pdo->prepare("INSERT INTO inventaris ");
    	$stmt->execute(array($_POST["productnummer"]));
    }
    
    $query = $pdo->prepare("SELECT * FROM inventaris");
    $query->execute();
    $array = array();
    
    while($row = $query->fetch()){
    	$productnummer = $row['Productnummer'];
    	$actief = $row['actief'];
    	$product = $row['Product'];
    	$beschrijving = $row['Product'];
    	$aantal = $row['Aantal'];
    	$webshopurl = $row['WebshopURL'];
    	$imageurl = $row['ImageURL'];
    	
    	if ($actief == 1) {
    	print ("<img src='".$imageurl."' /> <br>");
    	print ("Productnummer: " . $productnummer . "<br>");
    	print ("Naam: ". $product . "<br>");
    	
    	print ("Aantal beschikbaar: " . $aantal . "<br>"); ?>
    	<form action="inventaris.php" method="post">
    	<input type="hidden" value="<?php print ($productnummer);?>" name="productnummer">
    	<input type="submit" value="plus" name="plus">
    	</form>
    	<form action="inventaris.php" method="post">
    	<input type="hidden" value="<?php print ($productnummer);?>" name="productnummer">
    	<input type="submit" value="min" name="min">
    	</form>
    	<form action="inventaris.php" method="post">
    	<input type="hidden" value="<?php print ($productnummer);?>" name="productnummer">
    	<input type="submit" value="Verwijder" name="verwijder">
    	</form>
    	<?php 
    	
    	print ("<br>");
    } 
    }
    
	
	?>
	
    <form action="inventaris.php" method="post">
    <input type="submit" value="Voeg een product toe" name="toevoegen">
    </form> 
    </body>
</html>