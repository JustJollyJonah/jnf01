
<?php

 
// Start the session, so we can retriev client information.
session_start();
$user = $_SESSION['user'];
 
// Load the database, and the respective functions.
include("../DatabaseFunctions.php");
$db = connectToServer("mysql:host=localhost;port=3307", "root", "usbw");
selectDatabase($db, "omega");
 
//if(!isset($_SESSION['user']) || checkUserLevel($db, $user) != 1)
//{
//    header('Location: login.php');
//}
 

if(isset($_SESSION['user'])){
	if(checkUserLevel($db, $user) == 1){
			
	}else{
		header('Location: login.php');
	}
}else{
	header('Location: login.php');
}

// EN nu de custom database functies.
$query = $db->prepare("SELECT * FROM medewerker");
$query->execute();
 
$txt_user = '';
 
while($row = $query->fetch())
{
    $txt_user .= "
        <tr>
            <td>{$row['Medewerkernummer']}</td>
            <td>{$row['Naam']}</td>
            <td>{$row['Achternaam']}</td>
            <td><input type=\"checkbox\" name=\"actief\" value=\"{$row['Actief']}\"></td>
            <td><a href=\"bewerkMedewerker.php?verwijder={$row['Medewerkernummer']}\">Verwijder</a></td>
            <td><a href=\"bewerkMedewerker.php?wijzig={$row['Medewerkernummer']}\">Wijzigen</a></td>
        </tr>";
}
 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="StylePortal.css">
<link rel="stylesheet" href="productlistStyle.css">
<title>Gebruikersbeheer</title>
</head>
    <body>
        <div class="banner">
            <a href="../bezoekerssite/index.php"><img src="../bezoekerssite/img/dynamiek_logo.png" alt="Dynamiek Logo" /></a>
            <p>Dynamiek Ateliers Login Portaal</p>
            <div class="nav">
                <div class="button"><a href="inventaris.php">Voorraad</a></div>
                <div class="button"><a href="CMS.php">CMS</a></div>
                <div class="button"><a href="gebruikersbeheer.php">Gebruikersbeheer</a></div>
            </div>
            <div class="LoggedInUser">
                <?php echo $user; ?><br />
                <a href="login.php" class="logoutbutton">Log uit</a>
            </div>
        </div>
        <table class="gebruikbeh">
            <tr>
                <th>Nummer</th>
                <th>Voornaam</th>
                <th>Achternaam</th>
                <th>Actief</th>
            </tr>
            <?php echo $txt_user; ?>
        </table>
    </body>
</html>
