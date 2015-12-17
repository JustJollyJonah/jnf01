<?php 
include ("../DatabaseFunctions.php");
if(isset($_SESSION['user'])){
	if(checkUserLevel($pdo, $user) == 1){
			
	}else{
		header('Location: login.php');
	}
}else{
	header('Location: login.php');
}

$pdo = connectToServer ( "mysql:host=localhost;port=3307", "root", "usbw" );
selectDatabase ( $pdo, "omega" );


?>