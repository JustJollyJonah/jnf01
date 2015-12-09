<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=${encoding}">
<title>Inventaris</title>
<link type="text/css" rel="stylesheet" src="bootstrap.css">
</head>
    <body>
    <?php
    //debug stuff
    session_start();
    //functions
    include('../DatabaseFunctions.php');
    
//     function Inv_Plus($InvID) {
//     	try {
//     		$pdo = connectToServer ( "mysql:host=localhost;port=3307", "root", "usbw" );
//     		selectDatabase ( $pdo, "omega" );
//     	} catch (Exception $e) {
//     		echo 'Caught exception: ',  $e->getMessage(), "\n";
//     	}
//     }
    
    function Inv_Min($InvID) {
    	 
    }
    
    function Inv_Del($InvID) {
    	
    }
    //Importeer bestanden
    
	//connect met database

    
    $pdo = connectToServer ( "mysql:host=localhost;port=3307;", "root", "usbw" );
    selectDatabase ( $pdo, "omega" );
    
    if (isset($_POST['plus'])){
    	$stmt = $pdo->prepare("UPDATE inventaris SET aantal = aantal + 1 WHERE Productnummer=?");
    	$stmt->execute(array($_POST["productnummer"]));
    } else if (isset($_POST['min'])){
    	$stmt = $pdo->prepare("UPDATE inventaris SET aantal = aantal - 1 WHERE Productnummer=?");
    	$stmt->execute(array($_POST["productnummer"]));
    } 

    
    $query = $pdo->prepare("SELECT * FROM inventaris");
    $query->execute();
    $array = array();
    
    while($row = $query->fetch()){
    	$productnummer = $row['Productnummer'];
    	$product = $row['Product'];
    	$beschrijving = $row['Product'];
    	$aantal = $row['Aantal'];
    	$webshopurl = $row['WebshopURL'];
    	$imageurl = $row['ImageURL'];
    	
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
    	<?php 
     	print ('<a href="" onclick='. Inv_Min($productnummer) .' class="plusbtn">minbtn</a><br />');
    	print ('<a href="" onclick='. Inv_Del($productnummer) .' class="plusbtn">Verwijderen</a><br />');
    	
    	print ("<br>");
    }
    
	
	?>
    </body>
</html>