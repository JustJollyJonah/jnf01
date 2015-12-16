<?php
include ('../../DatabaseFunctions.php');
include 'basis.php';


if (isset ( $_POST ['Ja_Verwijder'] )) {
	$stmt = $pdo->prepare ( "DELETE FROM inventaris WHERE Productnummer=?" );
	$stmt->execute ( array (
			$_POST ["productnummer"]
	) );
	$stmt = $pdo->prepare ( "ALTER TABLE `inventaris` DROP `Productnummer`;
							ALTER TABLE `inventaris` AUTO_INCREMENT = 1;
							ALTER TABLE `inventaris` ADD `Productnummer` int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST;" );
	$stmt->execute();
	header('location:../inventaris.php');
	exit();
} else if (isset ($_POST ['Nee_Verwijder'])) {
	header('location:../inventaris.php');
	exit();
	
} else if (isset ( $_POST ['verwijder'] )) { // Verwijder knop, echter verwijderen we hem niet, we zetten hem op niet actief
	print ("Weet u zeker dat u dit product wilt verwijderen, dit is onheroeperlijk.") ?>
				    	<form action="verwijderen.php" method="post">
						<input type="hidden" value="<?php print($_POST['productnummer']); ?>" name="productnummer"> 
						<input type="submit" value="Ja" name="Ja_Verwijder"> 
						<input type="submit" value="Nee" name="Nee_Verwijder">
						</form> 
    	<?php
				} 