<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Webpagina Framework</title>
<link rel="stylesheet" href="Style_chris_3.css">
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.18.1/build/cssgrids/cssgrids-min.css">
<!--<link rel="stylesheet" href="stylejonah.css">-->
</head>
<body>


	<div class="header">Hier komt logo te staan</div>

	<div class="navbar">
		<?php
		$file = file_get_contents ( "navbarLayout3.txt" );
		echo $file;
		
		header('Content-Type: text/html; charset=ISO-8859-1');
		include("DatabaseFunctions.php");
		
		$contents = array("home"=>"home.txt", "about"=>"about.txt", "product"=>"product.txt", "workshops"=>"workshops.txt");
		
		if (isset($_GET['page'])) {
			$page = $_GET['page'];
		} else {
			$page = "home";
		}
		
		?>
		</div>

	<div class="content">
		<pre><?php
		$content = file_get_contents($contents[$page]);
		echo $content;
		
// 		$home = file_get_contents ( "home.txt" );
// 		echo $home;
		
		?>
			</pre>
	</div>

	<div class="footer">
		<ul>
			<li><a href="">Home</a></li>
			<li><a href="">Over Dynamiek ateliers</a></li>
			<li><a href="">Accesoires en producten</a></li>
			<li><a href="">Workshops</a></li>
			<li><a href="">Webshop</a></li>
		</ul>
	</div>
</body>
</html>
