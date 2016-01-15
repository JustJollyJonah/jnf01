<?php

// Start the session, so we can retriev client information.
session_start();
$user = $_SESSION['user'];
 
// Load the database, and the respective functions.
include("../DatabaseFunctions.php");
$db = connectToServer("mysql:host=178.62.201.206;port=3306", "omega", "usbw");
selectDatabase($db, "omega");

if(isset($_SESSION['user'])){
	if(checkUserLevel($db, $user) == 1){
			
	}else{
		header('Location: login.php');
	}
}else{
	header('Location: login.php');
}

// EN nu de custom database functies.

 
//$txt_user = '';

//     $txt_user .= 
//     	"<tr>
//             <td>{$row['Medewerkernummer']}</td>
//             <td>{$row['Naam']}</td>
//             <td>{$row['Achternaam']}</td>
//             <td>{$checked}</td>
//             <td><a href=\"bewerkMedewerker.php?verwijder={$row['Medewerkernummer']}\">Verwijder</a></td>
//             <td><a href=\"bewerkMedewerker.php?wijzig={$row['Medewerkernummer']}\">Wijzigen</a></td>
//         </tr>";
// }


//{$row['Actief']}

 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="StylePortal.css">
<link rel="stylesheet" href="productlistStyle.css">
<link
	href='https://fonts.googleapis.com/css?family=Open+Sans|Source+Sans+Pro|Raleway'
	rel='stylesheet' type='text/css'>
<title>Gebruikersbeheer</title>
</head>
    <body>
        <div class="banner">
            <a href="../bezoekerssite/index.php"><img src="../bezoekerssite/img/dynamiek_logo.png" alt="Dynamiek Logo" /></a>
            <h1>Dynamiek Ateliers Login Portaal</h1>
            <div class="nav">
                <div class="button"><a href="inventaris.php">Voorraad</a></div>
                <div class="button"><a href="CMS.php">CMS</a></div>
                <div class="button active"><a href="Gebruikersbeheer.php">Gebruikersbeheer</a></div>
            </div>
            <div class="LoggedInUser">
                <?php print("<p>".$user."</p>") ?>
                <a href="login.php" class="logoutbutton">Log uit</a>
            </div>
        </div>
        <div class="tdgebruikbeh">
         <div class='voegtoe'>
            <a class=buttonleft href="Gebruikertoevoegen.php">Medewerker toevoegen</a><br>
            </br>
            <a class=buttonleft href="Logintoevoegen.php">Login Toevoegen</a><br>
            </br>
            <a class=buttonleft href="loginverwijderen.php">Login verwijderen</a>
            </div>
        <table class="gebruikbeh">
            <tr class= "arielfont">
                <th>Nummer</th>
                <th>Voornaam</th>
                <th>Achternaam</th>
                <th>Actief</th>
            </tr>
          
           
            <?php 
            $query = $db->prepare("SELECT * FROM medewerker");
            $query->execute();
           	
            while($row = $query->fetch()){
            	$nummer = htmlspecialchars($row['Medewerkernummer']);
            	$naam = htmlspecialchars($row['Naam']);
            	$achternaam = htmlspecialchars($row['Achternaam']);
            	$actief = htmlspecialchars($row['Actief']);
            	echo "<tr><td>$nummer</td><td>$naam</td><td>$achternaam</td>"; 
            	if($actief){
            		echo "<td><input type=checkbox checked></td>";
            	}else{
            		echo "<td><input type=checkbox></td>";
            	}
            	echo "<td><a href=\"bewerkMedewerker.php?verwijder={$row['Medewerkernummer']}\">Verwijder</a></td>
            	<td><a href=\"Gebruikerwijzig.php?wijzig={$row['Medewerkernummer']}\">Wijzigen</a></td>";
            }

            ?>
        </table>
        </div>
    </body>
</html>