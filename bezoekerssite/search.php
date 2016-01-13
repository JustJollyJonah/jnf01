<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Webpagina Framework</title>
	<link rel="stylesheet" href="Style_chris_3.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link
	href='https://fonts.googleapis.com/css?family=Open+Sans|Source+Sans+Pro|Raleway'
	rel='stylesheet' type='text/css'>
	<!--<link rel="stylesheet" href="stylejonah.css">-->
</head>
<body>
	<div class="header">
	
	<?php
	if (isset ( $_GET ['page'] )) {				//
		$page = $_GET ['page'];					//Get current page
	} else {									//
		$page = "home";							//
	}
	?>
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
			<li class="navbar_item_webshop"
				<?php if($page=='webshop'){
					echo 'style="border-bottom:1px solid black;"';				//Create box shadow on current page button
				}?>><a
				href="webshop.php" class="a"><strong>Webshop</strong></a></li>
			<li class="navbar_item_workshops"
				<?php if($page=='workshops'){
					echo 'style="border-bottom:1px solid black;"';				//Create box shadow on current page button
				}?>><a
				href="index.php?page=workshops" class="a"><strong>Workshops</strong></a></li>
				
			<li class="navbar_item_product"
				<?php if($page=='product'){
					echo 'style="border-bottom:1px solid black;"';				//Create box shadow on current page button
				}?>><a
				href="index.php?page=product" class="a"><strong>Accesoires en producten</strong></a></li>
			<li class="navbar_item_about"
				<?php if($page=='about'){
					echo 'style="border-bottom:1px solid black;"';				//Create box shadow on current page button
				}?>><a
				href="index.php?page=about" class="a"><strong>Over Dynamiek ateliers</strong></a></li>
			<li class="navbar_item_home"
				<?php if($page=='home'){
					echo 'style="border-bottom:1px solid black;"';				//Create box shadow on current page button
				}?>><a
				href="index.php?page=home" class="a"><strong>Home</strong></a></li>
			
		</ul>
		<?php
		// $file = file_get_contents ( "navbarLayout3.txt" );
		// echo $file;
		
		header ( 'Content-Type: text/html; charset=ISO-8859-1' );
		include ("../DatabaseFunctions.php");
		include ("../phpfuncties.php");
		
		?>
		</div>
		<div id="slider">
			<figure> 
				<div><img src="img/slider/slide1.png"></div>
				<div><img src="img/slider/slide8.png"></div>
				<div><img src="img/slider/slide3.png"></div>
				<div><img src="img/slider/slide4.png"></div>
				<div><img src="img/slider/slide5.png"></div>
				<div><img src="img/slider/slide6.png"></div>
				<div><img src="img/slider/slide7.png"></div>
				<div><img src="img/slider/slide1.png"></div>
				<div><img src="img/slider/slide8.png"></div>
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
			<ul>
				<li><a href="index.php?page=home" class="a"><strong>Home</strong></a></li>
				<li><a href="index.php?page=about" class="a"><strong>Over
							Dynamiek ateliers</strong></a></li>
				<li><a href="index.php?page=product" class="a"><strong>Accesoires
							en producten</strong></a></li>
				<li><a href="index.php?page=workshops" class="a"><strong>Workshops</strong></a></li>
				<li><a href="" class="a"><strong>Webshop</strong></a></li>
				<li><a href=""></a></li>
			</ul>
		</details>
	</div>
	
	<div class="content">
		<div class="pagina"><?php
		
		// include ("DatabaseFunctions.php");
		// include ("phpfuncties.php");
		$pdo = connectToServer ( "mysql:host=178.62.201.206;port=3306", "omega", "usbw" );
		selectDatabase ( $pdo, "omega" );												//Connect to database
		$searchquery = $_GET ['searchquery'];											//Get search query
		echo "<h3>Zoekresultaten voor: </h3>  <i>$searchquery</i><br><br>";				//Echo search query
		
		$query = $pdo->prepare ( "SELECT * FROM pagina WHERE Tekst LIKE '%$searchquery%'" );		//
		$query->execute ();																			//fetch search results
		
		while ( $row = $query->fetch () ) {
			$page = $row ['Titel']; 																// get page title
			$tekst = explode ( ".", $row ['Tekst'] ); 												// get text from page(individual sentences
			
			echo "<a href=index.php?page=$page class=searchresult>$page</a><br>"; 					// create link to page
			foreach ( $tekst as $zin ) { 															// loop through text
				if (stripos ( $zin, trim ( $searchquery ) ) !== false) { 							// separate search query from sentence
					echo ucfirst ( ltrim ( $zin ) );
				}
			}
			echo "<br><br>";
		}
		
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
