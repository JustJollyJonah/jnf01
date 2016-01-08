<!DOCTYPE html>
<html>
<head>

</head>
<body>
	<?php
	
	include("../DatabaseFunctions.php");
	$toChange = "";																					//
	$toChange = $_GET ['toChange'];																	//Get text
	$bewerkt = $_GET ['Bewerk'];																	//Get page title
	
	$pdo = connectToServer ( "mysql:host=localhost;port=3307", "root", "usbw" );					//
	selectDatabase ( $pdo, "omega" );																//Connect to database
	
	$query = $pdo->prepare("UPDATE pagina SET tekst='$bewerkt' WHERE titel='$toChange'");			//Setup query
	$query->execute();																				//Insert values
	
// 	$rows = $query->rowCount();
	
	header ( "Location: CMS.php?toChange=$toChange&Bewerkt=TRUE" );									//Reload the page
	
	?>
	</body>
</html>

