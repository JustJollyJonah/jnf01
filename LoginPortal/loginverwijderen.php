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
            <h1>Dynamiek Ateliers Login Portaal</h1>
            <div class="nav">
                <div class="button"><a href="inventaris.php">Voorraad</a></div>
                <div class="button"><a href="CMS.php">CMS</a></div>
                <div class="button active"><a href="Gebruikersbeheer.php">Gebruikersbeheer</a></div>
            </div>
        </div>
        <?php
//Sessie, database connectie en userlevelcheck
session_start();
$user = $_SESSION['user'];

include ("../DatabaseFunctions.php");
include ("../LoginPortal/CustomEncryption.php");
$db = connectToServer( "mysql:host=178.62.201.206;port=3306", "omega", "usbw" );
selectDatabase ( $db, "omega" );

if(isset($_SESSION['user'])){
	if(checkUserLevel($db, $user) == 1){
			
	}else{
		header('Location: login.php');
	}
}else{
	header('Location: login.php');
} 
if(isset($_POST['LoginSubmit']))
{
	$stmt = $db ->prepare ( "DELETE FROM login WHERE Gebruikersnaam=?");
	$stmt->execute (array($_POST['gebruikersnaam']));
	header("Location: Gebruikersbeheer.php");
}
?>
<form action="loginverwijderen.php" method="post" onsubmit="return confirm('Weet u zeker dat u deze gebruiker wilt verwijderen')">
<table class="tabelinfo">
			<tr>
				<td>Gebruikersnaam:</td>
				<td><input type="text" value="" name="gebruikersnaam" placeholder="Inlognaam" required /></td>
			</tr>
			<tr>
			<td></td>
			<td><input type="submit" name="LoginSubmit" value="Verzend"></td>
			</tr>
			</form>
        </body>
        </html>