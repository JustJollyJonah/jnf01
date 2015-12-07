<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>

<body>
<?php
session_start ();
include ("CustomEncryption.php");

$user = $_POST ['username'];
$pw = Encrypt($_POST ['password']);

$_SESSION['user'] = $user;

include ("DatabaseFunctions.php");
<<<<<<< HEAD
=======

>>>>>>> branch 'master' of https://github.com/JustJollyJonah/jnf01

$pdo = connectToServer ( "mysql:host=localhost;port=3307", "root", "usbw" );

selectDatabase ( $pdo, "omega" );

LogIn ( $pdo, $user, $pw );

function LogIn($pdo, $user, $pw) {
	$query = $pdo->prepare( "SELECT COUNT(*) test FROM login WHERE Gebruikersnaam=? AND Wachtwoord=? LIMIT 1" );
	$query->execute(array($user,$pw));
	
	while($row = $query->fetch()){
		$waarde = $row['test'];
		if($waarde == 1){
			header('Location: Ingelogd.php');
		}else{
			$_SESSION['falseLogin'] = TRUE;
			header('Location: newfile.php');
			$_SESSION['falseInfo'] = array($user,$pw);
		}
	}
}
?>
</body>
</html>