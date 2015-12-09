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
		<div class="search">
			<details>
				<summary title="Zoeken"></summary>
				<form action=search.php?page=search method=get>
					<input type=text name=searchquery placeholder=Search> <input
						type=submit name=page value=Search>
				</form>
			</details>
		</div>
	</div>
	
	<div class="navbar_mobile">
		<details value='test'>
			<summary>
				<img src="img/View_Details.png" width="40" height="40" alt="menu">
			</summary>
			<ul>
				<li><a href="index.php?page=home" class="a"><strong>Home</strong></a></li>
				<li><a href="index.php?page=about" class="a"><strong>Over
							Dynamiek ateliers</strong></a></li>
				<li><a href="index.php?page=product" class="a"><strong>Accesoires
							en producten</strong></a></li>
				<li><a href="index.php?page=workshops" class="a"><strong>Workshops</strong></a></li>
				<li><a href="webshop.php" class="a"><strong>Webshop</strong></a></li>
				<li><a href=""></a></li>
			</ul>
		</details>
	</div>
	<?php
	if (isset ( $_GET ['page'] )) {
		$page = $_GET ['page'];
	} else {
		$page = "home";
	}
	?>
	<div class="navbar">
		<ul class="navbar_list">
			<li class="navbar_item_home"
				<?php if($page=='home'){echo 'style="box-shadow: inset 0 0 10px 1px rgba(0,0,0,.3);"';}?>><a
				href="index.php?page=home" class="a"><strong>Home</strong></a></li>
			<li class="navbar_item_about"
				<?php if($page=='about'){echo 'style="box-shadow: inset 0 0 10px 1px rgba(0,0,0,.3);"';}?>><a
				href="index.php?page=about" class="a"><strong>Over Dynamiek
						ateliers</strong></a></li>
			<li class="navbar_item_product"
				<?php if($page=='product'){echo 'style="box-shadow: inset 0 0 10px 1px rgba(0,0,0,.3);"';}?>><a
				href="index.php?page=product" class="a"><strong>Accesoires en
						producten</strong></a></li>
			<li class="navbar_item_workshops"
				<?php if($page=='workshops'){echo 'style="box-shadow: inset 0 0 10px 1px rgba(0,0,0,.3);"';}?>><a
				href="index.php?page=workshops" class="a"><strong>Workshops</strong></a></li>
			<li class="navbar_item_webshop"
				<?php if($page=='webshop'){echo 'style="box-shadow: inset 0 0 10px 1px rgba(0,0,0,.3);"';}?>><a
				href="webshop.php" class="a"><strong>Webshop</strong></a></li>
			<li class="navbar_img"><a href=""></a></li>
		</ul>
		<?php
		// $file = file_get_contents ( "navbarLayout3.txt" );
		// echo $file;
		
		header ( 'Content-Type: text/html; charset=ISO-8859-1' );
		include ("../DatabaseFunctions.php");
		include ("../phpfuncties.php");
		
		$contents = array (
				"home" => "home.txt",
				"about" => "about.txt",
				"product" => "product.txt",
				"workshops" => "workshops.txt" 
		);
		
		?>
		</div>
		
		<div class=content>
			<div class=pagina>
				<?php 
				
				
				
				?>
			</div>
			<div class="facebook-feed">
			<div class="fb">
				<div id="fb-root"></div>
				<script>(function(d, s, id) {  var js, fjs = d.getElementsByTagName(s)[0];  if (d.getElementById(id)) return;  js = d.createElement(s); js.id = id;  js.src = "//connect.facebook.net/nl_NL/sdk.js#xfbml=1&version=v2.3";  fjs.parentNode.insertBefore(js, fjs);}(document, 'script', 'facebook-jssdk'));</script>
				<center>
					<div class="fb-page"
						data-href="https://www.facebook.com/Dynamiek-Ateliers-694744090613339/?fref=ts"
						data-tabs="timeline" data-width="500" data-height="700"
						data-small-header="false" data-adapt-container-width="true"
						data-hide-cover="false" data-show-facepile="true"></div>
				</center>
			</div>
		</div>
		</div>
	</body>
</html>