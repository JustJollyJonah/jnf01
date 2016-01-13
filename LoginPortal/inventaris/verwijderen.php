<?php
include ('../../DatabaseFunctions.php');
include 'basis.php';


if (isset ( $_POST['Verwijder'] )) {
	$stmt = $pdo->prepare ( "DELETE FROM inventaris WHERE Productnummer=?" );
	$stmt->execute ( array (
			$_POST["productnummer"]
	) );
	$stmt = $pdo->prepare ( "ALTER TABLE `inventaris` DROP `Productnummer`;
							ALTER TABLE `inventaris` AUTO_INCREMENT = 1;
							ALTER TABLE `inventaris` ADD `Productnummer` int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST;" );
	$stmt->execute();
	header('location: ../inventaris.php');
	echo "test";
}
?>