<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=${encoding}">
<title>Inventaris</title>
<link type="text/css" rel="stylesheet" href="bootstrap.css">
<link type="text/css" rel="stylesheet" href="StylePortal.css">
</head>
    <body>
    <div class="banner">
    	<img src="" alt="Hier komt het logo">
    	<p>Dynamiek Ateliers Login Portaal</p>
    	<div class="LoggedInUser"><?php session_start();
    	$user = $_SESSION['user'];
    	echo $user;?><br>
    	<a href="newfile.php">Log uit</a></div>
    </div>
    <?php
    //debug stuff
    //functions
    include('../DatabaseFunctions.php');
    
    
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
    
    echo '<div class="contents">';
    while($row = $query->fetch()){
    	$productnummer = $row['Productnummer'];
    	$product = $row['Product'];
    	$beschrijving = $row['beschrijving'];
    	$aantal = $row['Aantal'];
    	$webshopurl = $row['WebshopURL'];
    	$imageurl = $row['ImgURL'];
    	
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
    	
    	print ("<br>");
    }
    echo "</div>";
    
	
	?>
    </body>
</html>