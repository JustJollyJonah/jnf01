<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="StylePortal.css">
<link rel="stylesheet" href="productlistStyle.css">
<title>Insert title here</title>
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
    	<div class="addProduct">
    		<a href='bewerkProduct.php'>Product toevoegen</a><br>
    		<a href='bewerkProduct.php'>Product verwijderen</a><br>
    		<a href='bewerkProduct.php'>Product aanpassen</a>
    	</div><br>
    	<a href="CMS.php">CMS</a>
    	<?php 
    	if(isset($_SESSION['user'])){
    		
    	}else{
    		header('Location: newfile.php');
    	}
    	include("../DatabaseFunctions.php");
    	$pdo = connectToServer ( "mysql:host=localhost;port=3307", "root", "usbw" );
    	selectDatabase ( $pdo, "omega" );
    	
    	$kwerie = $pdo->prepare("SELECT * FROM inventaris");
    	$kwerie->execute();
    	
    	while($row = $kwerie->fetch()){
    		$productnummer = $row['Productnummer'];
    		$product = $row['Product'];
    		$beschrijving = $row['Product'];
    		$beschikbaar = $row['Beschikbaarheid'];
    		$webshopurl = $row['WebshopURL'];
    		$imageurl = $row['ImageURL'];
    		
    		echo $productnummer . " " .  $product . " " . $beschrijving . " " . $beschikbaar . " " . $webshopurl . " " . $imageurl;
    	}
    	
//     	echo checkUserLevel($pdo, $user);
    	?>
    	
    	<div class="plus_button"></div>
    	
    </body>
</html>