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
	include("../DatabaseFunctions.php");
	$pdo = connectToServer ( "mysql:host=localhost;port=3307", "root", "usbw" );
	selectDatabase ( $pdo, "omega" );
	if(isset($_SESSION['user'])){
		if(checkUserLevel($pdo, $user) == 1){
			
		}else{
			header('Location: login.php');
		}
	}else{
		header('Location: login.php');
	}
	
	$query = $pdo->prepare("SELECT * FROM medewerker");
	$query->execute();
	
	echo "<table>";
	echo "<tr><th>Nummer</th><th>Voornaam</th><th>Achternaam</th><th>actief</th></tr>";
	while($row = $query->fetch()){
		$nummer = $row['Medewerkernummer'];
		$voornaam = $row['Naam'];
		$achternaam = $row['Achternaam'];
		$actief = $row['Actief'];
// 		echo $voornaam . "<br>";
		
		echo "
    	<tr>
			<td>$nummer</td><td>$voornaam</td><td>$achternaam</td><td><input type=checkbox name='actief' value=$actief></td>
			<td><a href=bewerkMedewerker.php?verwijder=$nummer>Verwijder</a></td>
		</tr>";
	}
	echo "</table>";
	echo "</form>";
	?>
	</body>
</html>