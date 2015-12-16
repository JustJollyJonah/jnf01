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
    		<a class=button href=inventaris.php>Voorraad</a>
    		<a class=button href=CMS.php>CMS</a>
    		<a class=button href=gebruikersbeheer.php>Gebruikersbeheer</a>
    		<div class="LoggedInUser"><?php 
    			session_start();
    			$user = $_SESSION['user'];
    			echo $user;
    			?><br>
    			<a href="login.php" class=button>Log uit</a>
    		</div>
    	</div>
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
    	
//     	while($row = $kwerie->fetch()){
//     		$productnummer = $row['Productnummer'];
//     		$product = $row['Product'];
//     		$beschrijving = $row['Product'];
//     		$beschikbaar = $row['Beschikbaarheid'];
//     		$webshopurl = $row['WebshopURL'];
//     		$imageurl = $row['ImageURL'];
    		
//     		echo $productnummer . " " .  $product . " " . $beschrijving . " " . $beschikbaar . " " . $webshopurl . " " . $imageurl;
//     	}
    	
//     	echo checkUserLevel($pdo, $user);
    	?>
    	
    </body>
</html>