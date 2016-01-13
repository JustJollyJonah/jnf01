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
    		<a href="../bezoekerssite/index.php"><img src="../bezoekerssite/img/dynamiek_logo.png" alt="Dynamiek Logo"></a>
    		<h1>Dynamiek Ateliers Login Portaal</h1>
    		<div class=nav>
    			<div class=button><a href=inventaris.php>Voorraad</a></div>
    			<div class=button><a href=CMS.php>CMS</a></div>
    			<div class=button><a href=gebruikersbeheer.php>Gebruikersbeheer</a></div>
    		</div>
    		<div class="LoggedInUser"><?php 
    			session_start();
    			$user = $_SESSION['user'];
    			print("<p>".$user."</p>");
    			?>
    			<a href="login.php" class=logoutbutton>Log uit</a>
    		</div>
    	</div>
    	<?php 
    	if(isset($_SESSION['user'])){
    		
    	}else{
    		header('Location: newfile.php');
    	}
    	include("../DatabaseFunctions.php");
    	$pdo = connectToServer ( "mysql:host=178.62.201.206;port=3306", "omega", "usbw" );
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