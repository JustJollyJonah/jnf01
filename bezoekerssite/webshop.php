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
				<li><a href="index.php?page=about" class="a"><strong>Over Dynamiek
							ateliers</strong></a></li>
				<li><a href="index.php?page=product" class="a"><strong>Accesoires en
							producten</strong></a></li>
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
				href="index.php?page=about" class="a"><strong>Over Dynamiek ateliers</strong></a></li>
				
			<li class="navbar_item_product"
				<?php if($page=='product'){echo 'style="box-shadow: inset 0 0 10px 1px rgba(0,0,0,.3);"';}?>><a
				href="index.php?page=product" class="a"><strong>Accesoires en producten</strong></a></li>
				
			<li class="navbar_item_workshops"
				<?php if($page=='workshops'){echo 'style="box-shadow: inset 0 0 10px 1px rgba(0,0,0,.3);"';}?>><a
				href="index.php?page=workshops" class="a"><strong>Workshops</strong></a></li>
				
			<li class="navbar_item_webshop"
				<?php if($page=='webshop'){echo 'style="box-shadow: inset 0 0 10px 1px rgba(0,0,0,.3);"';}?>><a
				href="webshop.php" class="a"><strong>Webshop</strong></a></li>
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
		</ul>
		<script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.5.9/slick.min.js"></script>
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
		
		// 		?>
	</div>

	<div class=content>
		<div class=pagina>
			<h2>Producten</h2>
			<form action="" method="get">
				Producten per pagina:
				<select name="results_per_page">
					<option value=5>5</option>
					<option value=10>10</option>
					<option value=15>15</option>
					<option value=20>20</option>
				</select>
				<input type=submit value=Herladen>
			</form>
			<table class=webshop>
				<?php
				$pdo = connectToServer ( "mysql:host=localhost;port=3307;", "root", "usbw" );
				selectDatabase ( $pdo, 'omega' );
				
				if(isset($_GET['results_per_page'])){
					$aantalPerPagina = $_GET['results_per_page'];
				}else{
					$aantalPerPagina = 5;
				}
				
				if (isset ( $_GET ['page'] )) {
					$page = $_GET ["page"];
				} else {
					if (isset ($_POST['page'])){
						$page = $_POST ['page'];
					} else {
						$page = 1;
					}
				}
				
				
				$query = $pdo->prepare ( "SELECT * FROM inventaris" );
				$query->execute ();
				$aantal = $query->rowCount ();
				$totaalPagina = ceil ( $aantal / $aantalPerPagina );
				$start_from = ($page - 1) * $aantalPerPagina;
				
				$query = $pdo->prepare ( "SELECT * FROM inventaris WHERE actief=1 LIMIT $start_from, $aantalPerPagina" );
				$query->execute ();
			
				while ( $row = $query->fetch () ) {
					$product = $row ['Product'];
					$beschrijving = $row ['Beschrijving'];
					$active = $row ['Actief'];
					$image = $row ['ImageURL'];
					$shop_url = $row ['WebshopURL'];
					$categorie = $row ['Categorienummer'];
					$eigenschap = $row ['Eigenschap'];
				
					if ($active) {
						echo "<tr>";
						echo "<td><img src='../LoginPortal/" . trim($image) . "' width=80 height=80 alt='Plaats plaatje hier!'></td>";
						echo "<td><strong>$beschrijving</strong></td>";
						echo "<td><a href=$shop_url>Bestellen</a></td>";
						echo "</tr>";
					}
				}
				
				
				
				?>
				</table>
				<?php 
				echo "<div class=paginate>";
				
				if (!isset ( $_POST ['toevoegen'] ) && !isset($_POST['wijzigen'])) {
					if ($page != 1) {
						echo ("<a href=webshop.php?page=1&results_per_page=$aantalPerPagina class=paginate_button> |< </a>");
						$lastpagina = $page - 1;
						echo ("<a href=webshop.php?page=$lastpagina&results_per_page=$aantalPerPagina class=paginate_button> < </a>");
					}
					for($i = 1; $i < $totaalPagina + 1; $i ++) {
						echo ("<a href=webshop.php?page=$i&results_per_page=$aantalPerPagina class=paginate_button>" . $i . "</a>");
					}
				
					$nextpagina = $page + 1;
					if ($page != $totaalPagina) {
						echo ("<a href=webshop.php?page=$nextpagina&results_per_page=$aantalPerPagina class=paginate_button> > </a>");
						echo ("<a href=webshop.php?page=$totaalPagina&results_per_page=$aantalPerPagina class=paginate_button> >| </a>");
					}
				}
				?>
				</div>
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
		<a href="../LoginPortal/login.php" class="loginLink">Login</a>
	</div>
</body>
</html>