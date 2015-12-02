<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Webpagina Framework</title>
<link rel="stylesheet" href="Style_chris_3.css">
<link rel="stylesheet" type="text/css"
	href="http://yui.yahooapis.com/3.18.1/build/cssgrids/cssgrids-min.css">
<!--<link rel="stylesheet" href="stylejonah.css">-->
</head>
<body>


	<div class="header">
		<img src="img/Logo_01.jpg" class="img_logo"> <img
			src="img/Logo_02.png"
			style="margin-left: 0px; float: bottom; margin-bottom: 0px;">
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
		$pdo = connectToServer ( "mysql:host=localhost;port=3307", "root", "usbw" );
		selectDatabase ( $pdo, "omega" );
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
		<ul>
			<li><a href="">Home</a></li>
			<li><a href="">Over Dynamiek ateliers</a></li>
			<li><a href="">Accesoires en producten</a></li>
			<li><a href="">Workshops</a></li>
			<li><a href="">Webshop</a></li>
		</ul>
		<a href="../LoginPortal/newfile.php" class="loginLink">Login</a>
	</div>
</body>
</html>
