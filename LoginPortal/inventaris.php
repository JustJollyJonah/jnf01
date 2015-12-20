<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=${encoding}">
		<title>Inventaris</title>
		<link type="text/css" rel="stylesheet" href="bootstrap.css">
		<link rel="stylesheet" href="StylePortal.css">
		<link rel="stylesheet" href="productlistStyle.css">
	</head>
	<body>
		<div class="banner">
    		<img src="" alt="Hier komt het logo">
    		<p>Dynamiek Ateliers Login Portaal</p>
    		<div class=nav>
    			<div class=button><a href=inventaris.php>Voorraad</a></div>
    			<div class=button><a href=CMS.php>CMS</a></div>
    			<div class=button><a href=gebruikersbeheer.php>Gebruikersbeheer</a></div>
    		</div>
    		<div class="LoggedInUser"><?php 
    			session_start();
    			$user = $_SESSION['user'];
    			echo $user;
    			?><br>
    			<a href="login.php" class=logoutbutton>Log uit</a>
    		</div>
    	</div>
    	<div class="wrapper">
    	<form action="inventaris/toevoegen.php" method="post" class="product_mgmt">
			<input type="submit" value="Voeg een product toe" name="toevoegen">
		</form> 
		<div class=productList>
    <?php
		// Toevoegen van de standaardcode die op elke inventaris pagina moet
    	include ('../DatabaseFunctions.php');
		include 'inventaris/basis.php';

				
		// pagina vaststellen
		if (isset ( $_GET ['pagina'] )) {
			$pagina = $_GET ["pagina"];
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
		$aantalPerPagina = 12;
		$totaalPagina = ceil ( $aantal / $aantalPerPagina );
				
		//De knop plus, die wordt uitgevoerd door op inventaris pagina op plus te klikken
		if (isset ( $_POST ['plus'] )) { 
			$stmt = $pdo->prepare ( "UPDATE inventaris SET Beschikbaarheid = Beschikbaarheid + 1 WHERE Productnummer=?" );
			$stmt->execute ( array ($_POST ["productnummer"] ) );
			
		//De knop min, die wordt uitgevoerd door op de inventaris pagina op min te klikken
		} else if (isset ( $_POST ['min'] )) { 
			$stmt = $pdo->prepare ( "UPDATE inventaris SET Beschikbaarheid = Beschikbaarheid - 1 WHERE Productnummer=?" );
			$stmt->execute ( array ($_POST ["productnummer"]) );	 

		// Deze functie maakt de POST weer leeg, zodat hij alle producten laat zien
		} else if (isset ( $_POST ['terug'] )) {
					$_POST = '';
		}
				
		//Verdeling van de producten op de pagina
		$start_from = ($pagina - 1) * $aantalPerPagina;
		$query = $pdo->prepare ( "SELECT * FROM inventaris LIMIT $start_from, $aantalPerPagina" );
		$query->execute ();
		$array = array ();
		$aantalProducten = $query->rowCount () + 1;
					
					
		//De Query die wordt uitgevoerd om alles uit de database te halen, deze wordt gelimiteerd op $aantalPerPagina
		for($i = 1; $i < $aantalProducten; $i ++) {
			$query = $pdo->prepare ( "SELECT * FROM inventaris WHERE productnummer = $i + $pagina * $aantalPerPagina - $aantalPerPagina" );
			$query->execute ();
			while ( $row = $query->fetch () ) {
				
				//De variabelen zodat je database kan uitlezen
				$productnummer = $row ['Productnummer'];
				$actief = $row ['Actief'];
				$product = $row ['Product'];
				$beschrijving = $row ['Beschrijving'];
				$aantal = $row ['Beschikbaarheid'];
				$webshopurl = $row ['WebshopURL'];
				$imageurl = $row ['ImageURL'];
				
				//het lijstje wat getoond wordt op de site
				echo "<div class='Product'>";
				print ("<img width='100px' height='100' src='" . $imageurl . "' alt='No Image Available'/> <br>") ;
				print ("Productnummer: " . $productnummer . "<br>") ;
				print ("Naam: " . $product . "<br>") ;
				print ("Beschrijving: " . $beschrijving . "<br>") ;
				print ("Aantal beschikbaar: " . $aantal . "<br>") ;
				//Actief in actief zin
				if ($actief == 1) {
					print ("Het product is actief op de site") ;
				} else {
					print ("<div class='inactief'>Het product is niet actief op de site</div>") ;
				}

				//De knopjes van plus en min fysiek
	?>
    		<form action="inventaris.php" method="post">
				<input type="hidden" value="<?php print ($productnummer);?>" name="productnummer"> 
				<input type="hidden" value="<?php print ($pagina);?>" name="pagina">
				<input type="submit" value="plus" name="plus">
				<input type="submit" value="min" name="min">
	<?php
				// Laat de knop zien om hem snel te wijzigen van actief naar inactief
				if ($actief == 1) {
					print ('<input type="submit" value="Maak inactief" name="maak_inactief">') ;
				} else {
					print ('<input type="submit" value="Maak Actief" name="maak_actief">') ;
				}
	?>
    	
			</form>
			
			<!-- Dit moet een knop worden die verwijsd naar de Wijzigen pagina -->
			<button onclick="window.location=inventaris/wijzigen.php?productnummer=<?php print ($productnummer);?>">Wijzigen</button>
	
			<!-- Dit moet een knop worden die verwijsd naar de Verwijder pagina -->
			<button onclick="window.location=inventaris/verwijderen.php?productnummer=<?php print ($productnummer);?>">Verwijderen</button>
			
			<!-- Dit is nog debug code -->
			<form action="inventaris/verwijderen.php" method="post">
				<input type="hidden" value="<?php print ($productnummer);?>" name="productnummer"> 
				<input type="submit" value="Verwijder oude manier" name="verwijder">	
			</form>
			
			<form action="inventaris/wijzigen.php" method="post">
				<input type="hidden" value="<?php print ($productnummer);?>" name="productnummer"> 
				<input type="submit" value="Wijzigen oude manier" name="wijzigen">	
			</form>
		</div>
    <?php
    		//Sluit de While
			}
		//Sluit de For
		}
		print ("<br>") ;
				
		
		echo "<div class=paginate>";
				
		if (!isset ( $_POST ['toevoegen'] ) && !isset($_POST['wijzigen'])) {		
			if ($pagina != 1) {
				echo ("<a href=inventaris.php?pagina=1 class=paginate_button> |< </a>");
				$lastpagina = $pagina - 1;
				echo ("<a href=inventaris.php?pagina=$lastpagina class=paginate_button> < </a>");
			}
				for($i = 1; $i < $totaalPagina + 1; $i ++) {
				echo ("<a href=inventaris.php?pagina=$i class=paginate_button>" . $i . "</a>");
		}
						
		$nextpagina = $pagina + 1;
		if ($pagina != $totaalPagina) {
			echo ("<a href=inventaris.php?pagina=$nextpagina class=paginate_button> > </a>");
			echo ("<a href=inventaris.php?pagina=$totaalPagina class=paginate_button> >| </a>");
		}
	}
	?>
	</div>
	</div>
	</div>
    </body>
</html>