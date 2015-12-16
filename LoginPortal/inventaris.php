<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=${encoding}">
<title>Inventaris</title>
<link type="text/css" rel="stylesheet" src="bootstrap.css">
</head>
<body>
    <?php

    			include ('../DatabaseFunctions.php');
				include 'inventaris/basis.php';

				
				// pagina vaststellen
				if (isset ( $_GET ['page'] )) {
					$pagina = $_GET ["page"];
				} else {
					if (isset ($_POST['pagina'])){
						$pagina = $_POST ['pagina'];
					} else {
						$pagina = 1;
					}
				} 
				
				// pagina verdeling
				$query = $pdo->prepare ( "SELECT * FROM inventaris" );
				$query->execute ();
				$aantal = $query->rowCount ();
				$aantalPerPagina = 3;
				$totaalPagina = ceil ( $aantal / $aantalPerPagina );
				
				// Hier komt alles vanuit een post te staan
				if (isset ( $_POST ['plus'] )) { // Plus knop
					$stmt = $pdo->prepare ( "UPDATE inventaris SET Beschikbaarheid = Beschikbaarheid + 1 WHERE Productnummer=?" );
					$stmt->execute ( array (
							$_POST ["productnummer"] 
					) );
				} else if (isset ( $_POST ['min'] )) { // Min knop
					$stmt = $pdo->prepare ( "UPDATE inventaris SET Beschikbaarheid = Beschikbaarheid - 1 WHERE Productnummer=?" );
					$stmt->execute ( array (
							$_POST ["productnummer"] 
					) );
				 

					// voert de database query uit
				} else if (isset ( $_POST ['terug'] )) {
					$_POST = '';
				}
				
				if (!isset ( $_POST ['toevoegen']) && !isset ($_POST['wijzigen'])) {
					$start_from = ($pagina - 1) * $aantalPerPagina;
					$query = $pdo->prepare ( "SELECT * FROM inventaris LIMIT $start_from, $aantalPerPagina" );
					$query->execute ();
					$array = array ();
					$aantalProducten = $query->rowCount () + 1;
					
					for($i = 1; $i < $aantalProducten; $i ++) {
						$query = $pdo->prepare ( "SELECT * FROM inventaris WHERE productnummer = $i + $pagina * $aantalPerPagina - $aantalPerPagina" );
						$query->execute ();
						while ( $row = $query->fetch () ) {
							$productnummer = $row ['Productnummer'];
							$actief = $row ['Actief'];
							$product = $row ['Product'];
							$beschrijving = $row ['Beschrijving'];
							$aantal = $row ['Beschikbaarheid'];
							$webshopurl = $row ['WebshopURL'];
							$imageurl = $row ['ImageURL'];
							
							print ("<img width='100px' height='auto' src='" . $imageurl . "' /> <br>") ;
							print ("Productnummer: " . $productnummer . "<br>") ;
							print ("Naam: " . $product . "<br>") ;
							print ("Beschrijving: " . $beschrijving . "<br>") ;
							print ("Aantal beschikbaar: " . $aantal . "<br>") ;
							if ($actief == 1) {
								print ("Het product is actief op de site") ;
							} else {
								print ("<div class='inactief'>Het product is niet actief op de site</div>") ;
							}
							?>
    	<form action="inventaris.php" method="post">

		<input type="hidden" value="<?php print ($productnummer);?>" name="productnummer"> 
		<input type="hidden" value="<?php print ($pagina);?>" name="pagina">
		<input type="submit" value="plus" name="plus">
		<input type="submit" value="min" name="min">
						<?php
							
							if ($actief == 1) {
								print ('<input type="submit" value="Maak inactief" name="maak_inactief">') ;
							} else {
								print ('<input type="submit" value="Maak Actief" name="maak_actief">') ;
							}
							?>
    	
	
	</form>
	
		<form action="inventaris/verwijderen.php" method="post">
		<input type="hidden" value="<?php print ($productnummer);?>" name="productnummer"> 
		<input type="submit" value="Verwijder" name="verwijder">	
		</form>
		
		<!-- Verwijzen naar het inventaris wijzigen script -->
		<form action="inventaris/wijzigen.php" method="post">
		<input type="hidden" value="<?php print ($productnummer);?>" name="productnummer"> 
		<input type="submit" value="Wijzigen" name="wijzigen">
		</form>
    	
    	<?php
						}
					}
					print ("<br>") ;
				}
				
				if (!isset ( $_POST ['toevoegen'] ) && !isset($_POST['wijzigen'])) {
					
					if ($pagina != 1) {
						echo ("<a href=inventaris.php?page=1> |< </a>");
						$lastpage = $pagina - 1;
						echo ("<a href=inventaris.php?page=$lastpage> < </a>");
					}
						for($i = 1; $i < $totaalPagina + 1; $i ++) {
							echo ("<a href=inventaris.php?page=$i>" . $i . "</a>");
						}
					
					
					$nextpage = $pagina + 1;
					if ($pagina != $totaalPagina) {
						echo ("<a href=inventaris.php?page=$nextpage> > </a>");
						echo ("<a href=inventaris.php?page=$totaalPagina> >| </a>");
					}

					?>
	

    	<form action="inventaris/toevoegen.php" method="post">
		<input type="submit" value="Voeg een product toe" name="toevoegen">
		</form>  
	<?php 			 } ?>
    </body>
</html>