<!DOCTYPE html>
<html>
<head>

</head>
<body>
	<?php
	$toChange = "";
	$toChange = $_GET ['toChange'];
	$bewerkt = $_GET ['Bewerk'];
	
	file_put_contents ( $toChange, $bewerkt );
	
	header ( "Location: Ingelogd.php?toChange=$toChange&Bewerkt=TRUE" );
	
	?>
	</body>
</html>

