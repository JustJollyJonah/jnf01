<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Webpagina Framework</title>
<link rel="stylesheet" href="Style_chris_2.css">
<!--<link rel="stylesheet" href="stylejonah.css">-->
</head>
<body>


	<div class="header">
		Hier komt logo te staan
	</div>
	<div class="nav_other">
		andere navigatie?
	</div>
	
	<div class="wrapper">
		<div class="navbar">
		<?php
		$file = file_get_contents ( "navbar.txt" );
		echo $file;
		
		?>
		</div>
		
		<div class="subnav">
			subnavigatie?
		</div>

		<div class="content">
			<pre><?php
		
			$home = file_get_contents ( "home.txt" );
			echo $home;
		
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
	</div>
</body>
</html>
