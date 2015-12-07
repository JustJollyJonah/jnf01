<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Webpagina Framework</title>
<link rel="stylesheet" href="Style_chris_3.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href='https://fonts.googleapis.com/css?family=Open+Sans|Source+Sans+Pro|Raleway' rel='stylesheet' type='text/css'>
<!--<link rel="stylesheet" href="stylejonah.css">-->
</head>
<body>


	<div class="header">
		<img src="img/dynamiek_logo.png" class="img_logo">
	</div>
	
	<div class="navbar_mobile">
		<details value='test'>
		<summary><strong>Menu</strong></summary>
			<ul>
				<li><a href="indexLayout3.php?page=home" class="a"><strong>Home</strong></a></li>
				<li><a href="indexLayout3.php?page=about" class="a"><strong>Over Dynamiek ateliers</strong></a></li>
				<li><a href="indexLayout3.php?page=product" class="a"><strong>Accesoires en producten</strong></a></li>
				<li><a href="indexLayout3.php?page=workshops" class="a"><strong>Workshops</strong></a></li>
				<li><a href="" class="a"><strong>Webshop</strong></a></li>
				<li><a href=""></a></li>
			</ul>
		</details>
	</div>

	<div class="navbar">
		<?php
		$file = file_get_contents ( "navbarLayout3.txt" );
		echo $file;
		
		header ( 'Content-Type: text/html; charset=ISO-8859-1' );
		include ("DatabaseFunctions.php");
		include ("phpfuncties.php");
		
		$contents = array (
				"home" => "home.txt",
				"about" => "about.txt",
				"product" => "product.txt",
				"workshops" => "workshops.txt" 
		);
		
		if (isset ( $_GET ['page'] )) {
			$page = $_GET ['page'];
		} else {
			$page = "home";
		}
		
		?>
		</div>

	<div class="content">
		<pre><?php
		$pdo = connectToServer ( "mysql:host=localhost;port=3307;", "root", "usbw" );
		selectDatabase($pdo, 'omega');
// 		$content = file_get_contents ( $contents [$page] );
// 		echo $content;

		echo fetchWithException($pdo, "pagina", "tekst", "titel='$page'");
		
		// $home = file_get_contents ( "home.txt" );
		// echo $home;
		
		?>
		</pre>
			<div class="test">
			
			<?php

// 			$array = array ("code","omschrijving" );
// 			print_array(fetchRows ( $pdo, "cursus", $array, "testdata"));
			
// 			echo fetchWithException($pdo, 'cursus', "omschrijving", "omschrijving LIKE '%SQL%'");

			?>
			</div>
	</div>

	<div class="footer">
		<img src="img/dynamiek_logo.png" class="img_logo">
		<ul>
			<li><a href="?page=home">Home</a></li>
			<li><a href="?page=about">Over Dynamiek ateliers</a></li>
			<li><a href="?page=product">Accesoires en producten</a></li>
			<li><a href="?page=workshops">Workshops</a></li>
			<li><a href="">Webshop</a></li>
		</ul>
		<a href="../LoginPortal/newfile.php" class="loginLink">Login</a>
	</div>
</body>
</html>
