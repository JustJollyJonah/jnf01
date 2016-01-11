<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Webpagina Framework</title>
<link rel="stylesheet" href="Style_chris_3.css">
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.5.9/slick.css"/>
<link rel=stylesheet href=style_mobile_1>
<link rel=stylesheet href=style_mobile_2>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link
	href='https://fonts.googleapis.com/css?family=Open+Sans|Source+Sans+Pro|Raleway'
	rel='stylesheet' type='text/css'>
<!--<link rel="stylesheet" href="stylejonah.css">-->
</head>
<body>
<?php
	if (isset ( $_GET ['page'] )) {		//
		$page = $_GET ['page'];			//
	} else {							//Get current page
		$page = "home";					//
	}
	?>
	

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
		<div class="navbar">
		<ul class="navbar_list">
			<li class="navbar_item_home"
				<?php if($page=='home'){
					echo 'style="border-bottom:1px solid black;"';				//Create box shadow on current page button
				}?>><a
				href="index.php?page=home" class="a"><strong>Home</strong></a></li>
				
			<li class="navbar_item_about"
				<?php if($page=='about'){
					echo 'style="border-bottom:1px solid black;"';				//Create box shadow on current page button
				}?>><a
				href="index.php?page=about" class="a"><strong>Over Dynamiek ateliers</strong></a></li>
				
			<li class="navbar_item_product"
				<?php if($page=='product'){
					echo 'style="border-bottom:1px solid black;"';				//Create box shadow on current page button
				}?>><a
				href="index.php?page=product" class="a"><strong>Accesoires en producten</strong></a></li>
				
			<li class="navbar_item_workshops"
				<?php if($page=='workshops'){
					echo 'style="border-bottom:1px solid black;"';				//Create box shadow on current page button
				}?>><a
				href="index.php?page=workshops" class="a"><strong>Workshops</strong></a></li>
				
			<li class="navbar_item_webshop"
				<?php if($page=='webshop'){
					echo 'style="border-bottom:1px solid black;"';				//Create box shadow on current page button
				}?>><a
				href="webshop.php" class="a"><strong>Webshop</strong></a></li>
			</ul>
		<script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.5.9/slick.min.js"></script>
		<?php
		// $file = file_get_contents ( "navbarLayout3.txt" );
		// echo $file;	
		
		header ( 'Content-Type: text/html; charset=ISO-8859-1' );							//Set character set for special characters in content
		include ("../DatabaseFunctions.php");
		include ("../phpfuncties.php");
		?>
	</div>
	<div id="slider">
			<figure> 
				<div><img src="img/slider/slide1.png"></div>
				<div><img src="img/slider/slide2.png"></div>
				<div><img src="img/slider/slide3.png"></div>
				<div><img src="img/slider/slide4.png"></div>
				<div><img src="img/slider/slide5.png"></div>
				<div><img src="img/slider/slide6.png"></div>
				<div><img src="img/slider/slide7.png"></div>
				<div><img src="img/slider/slide1.png"></div>
				<div><img src="img/slider/slide2.png"></div>
				<div><img src="img/slider/slide3.png"></div>
				<div><img src="img/slider/slide4.png"></div>
				<div><img src="img/slider/slide5.png"></div>
			</figure>
			</div>
	
	</div>

	<div class="navbar_mobile">
		<details value='test'>
			<summary>
				<img src="img/View_Details.png" width="40" height="40" alt="menu">
			</summary>
			<div>
				<ul>
					<li><a href="index.php?page=home" class="a"><strong>Home</strong></a></li>
					<li><a href="index.php?page=about" class="a"><strong>Over Dynamiek
								ateliers</strong></a></li>
					<li><a href="index.php?page=product" class="a"><strong>Accesoires
								en producten</strong></a></li>
					<li><a href="index.php?page=workshops" class="a"><strong>Workshops</strong></a></li>
					<li><a href="webshop.php" class="a"><strong>Webshop</strong></a></li>
					<li><a href=""></a></li>
				</ul>
			</div>
		</details>
	</div>
	
	<div class="content">
		<div class="pagina">
			<pre><?php
			$pdo = connectToServer ( "mysql:host=localhost;port=3307;", "root", "usbw" );	//
			selectDatabase ( $pdo, 'omega' );												//Connect to database
																							//
			echo fetchWithException ( $pdo, "pagina", "tekst", "titel='$page'" );			//Fetch contents of page
			
			?></pre>
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

	<div class="footer">
		<img src="img/dynamiek_logo.png" class="img_logo">
		<ul>
			<li><a href="?page=home">Home</a></li>
			<li><a href="?page=about">Over Dynamiek ateliers</a></li>
			<li><a href="?page=product">Accesoires en producten</a></li>
			<li><a href="?page=workshops">Workshops</a></li>
			<li><a href="webshop.php">Webshop</a></li>
		</ul>
		<a href="../LoginPortal/login.php" class="loginLink">Login</a>
	</div>

</body>
</html>
