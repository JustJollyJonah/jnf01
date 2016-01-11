<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>

<body>
<?php
session_start ();
include ("CustomEncryption.php");														//Include encryptioo file

$user = $_POST ['username'];															//Get username
$pw = Encrypt($_POST ['password']);														//Get password

$_SESSION['user'] = $user;																//Set session user

include ("../DatabaseFunctions.php");													

$pdo = connectToServer ( "mysql:host=178.62.201.206;port=3306", "omega", "usbw" );			//
selectDatabase ( $pdo, "omega" );														//Connect to database

LogIn ( $pdo, $user, $pw );																//Execute LogIn function

function LogIn($pdo, $user, $pw) {
	$query = $pdo->prepare( "SELECT COUNT(*) users FROM login WHERE Gebruikersnaam=? AND Wachtwoord=? LIMIT 1" );	//Setup query to check username and pw
	$query->execute(array($user,$pw));																				//Insert values into query
	
	while($row = $query->fetch()){
		$waarde = $row['users'];																					//Fetch amount of users with this username/pw
		if($waarde == 1){																							//Check if there is only 1 user with this username=pw
			header('Location: Ingelogd.php');																		//Redirect
		}else{																										//
			$_SESSION['falseLogin'] = TRUE;																			//Give error on login page
			header('Location: login.php');																			//Redirect
			$_SESSION['falseInfo'] = array($user,$pw);																//
		}
	}
}
?>
</body>
</html>