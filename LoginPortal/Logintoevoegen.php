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



if(isset($_POST['MedewerkerSubmit']))
{
	$id = $_POST ['Medewerkernummer'];
	$functie = $_POST ['Functie'];
	$return_msg = "Het is verzonden, kut.";
	$stmt = $db ->prepare ( "INSERT INTO login (Gebruikersnaam, Wachtwoord, Medewerkernummer, Functie) VALUES (?,?,?,?)");
	$stmt->execute (array($_POST ['Gebruikersnaam'], encrypt ($_POST ['wachtwoord']), $id, $functie));
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
            <h1>Dynamiek Ateliers Login Portaal</h1>
            <div class="nav">
                <div class="button"><a href="inventaris.php">Voorraad</a></div>
                <div class="button"><a href="CMS.php">CMS</a></div>
                <div class="button active"><a href="gebruikersbeheer.php">Gebruikersbeheer</a></div>
            </div>
            <div class="LoggedInUser">
                <?php print("<p>".$user."</p>") ?>
                <a href="login.php" class="logoutbutton">Log uit</a>
            </div>
        </div>
        <table class="tabelinfo">
        <form method="POST">
        	<h2>Login toevoegen</h2>
        	<?php if(isset($return_msg) && !empty($return_msg)) { echo '<tr><td>' . $return_msg . '</td></tr>'; } ?>
			<tr>
				<td>Voor wie wilt u login gegevens toevoegen:</td>
				<td>
					<select name="Medewerkernummer">
					<?php 
					$query = $db->prepare("SELECT * FROM medewerker");
					$query->execute();
					while($row = $query->fetch()){
						echo "<option>" . $row['Medewerkernummer'] . "</option>";
					}
					?>
					</select>
				</td>
			</tr>			
				<td>Functie: </td>
				<td><select name="Functie"><?php $query = $db->prepare("SELECT * FROM functie");
					$query->execute();
					while($row = $query->fetch()){
						echo "<option>" . $row['Functie'] . "</option>";
					} ?></select></td>
			</tr>
			<tr>
				<td>Gebruikersnaam:</td>
				<td><input type="text" value="" name="Gebruikersnaam" placeholder="gebruikersnaam" required /></td>
			</tr>
			<tr>
				<td>Wachtwoord:</td>
				<td><input type="password" placeholder="Wachtwoord" name="wachtwoord" required /></td>
			</tr>
			<tr>	
			<td><input type="submit" name="MedewerkerSubmit" value="Verzend"></td>
			</tr>
		</table>
	</form>
	</body>
	</html>
