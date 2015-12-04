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
    	include("DatabaseFunctions.php");
    	$pdo = connectToServer ( "mysql:host=localhost;port=3307", "root", "usbw" );
    	selectDatabase ( $pdo, "omega" );
    	
    	$kwerie = $pdo->prepare("SELECT Product FROM inventaris");
    	$kwerie->execute();
    	$array = array();
    	
    	while($row = $kwerie->fetch()){
    		array_push($array, $row['Product']);
    	}
    	
    	print_r($array);
    	
    	$kwerie = $pdo->prepare("SELECT Beschrijving FROM inventaris");
    	$kwerie->execute();
    	$array = array();
    	 
    	while($row = $kwerie->fetch()){
    		array_push($array, $row['Beschrijving']);
    	}
    	 
    	print_r($array);
    	?>
    </body>
</html>