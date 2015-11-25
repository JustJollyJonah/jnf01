<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>

<body>
<?php
session_start ();

$user = $_POST ['username'];
$pw = $_POST ['password'];

$_SESSION['user'] = $user;

include ("DatabaseFunctions.php");

$pdo = connectToServer ( "mysql:host=localhost;port=3307", "root", "usbw" );

selectDatabase ( $pdo, "avondschool" );

LogIn ( $pdo, $user, $pw );

function LogIn($pdo, $user, $pw) {
	$query = $pdo->prepare( "SELECT COUNT(*) test FROM cursist WHERE voornaam='$user' AND cursistnr='$pw' LIMIT 1" );
	$query->execute();
	
	while($row = $query->fetch()){
		$waarde = $row['test'];
		if($waarde == 1){
			header('Location: Ingelogd.php');
		}else{
			$_SESSION['falseLogin'] = TRUE;
			header('Location: newfile.php');
		}
	}
}
?>
</body>
</html>