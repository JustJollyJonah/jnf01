<!DOCTYPE html>
<html>
<head>

</head>
<body>
	<?php
	
	include("DatabaseFunctions.php");
	$toChange = "";
	$toChange = $_GET ['toChange'];
	$bewerkt = $_GET ['Bewerk'];
	
	$pdo = connectToServer ( "mysql:host=localhost;port=3307", "root", "usbw" );
	selectDatabase ( $pdo, "omega" );
	
	$query = $pdo->prepare("UPDATE pagina SET tekst='$bewerkt' WHERE titel='$toChange'");
	$query->execute();
	
// 	$rows = $query->rowCount();
	
	header ( "Location: Ingelogd.php?toChange=$toChange&Bewerkt=TRUE" );
	
	?>
	</body>
</html>

