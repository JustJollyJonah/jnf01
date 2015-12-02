<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>

<body>
<?php
session_start ();

$user = $_POST ['username'];
$pw = md5($_POST ['password']);

$_SESSION['user'] = $user;

include ("DatabaseFunctions.php");
include ("CustomEncryption.php");

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