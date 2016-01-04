<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" href="StylePortal.css">
		<link rel="stylesheet" href="cmsStyle.css">
		<script src="WYSIWYG\tinymce\js\tinymce\tinymce.min.js"></script>
		<script>
			tinymce.init({
				selector: '#mytextarea',
				plugins: 'autoresize'
			});
		</script>
		<title>Insert title here</title>
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
		<div class="contents">
			<div class="contentLeft">
				<form class="cmsSelect" method='GET' action="CMS.php">
					<legend>Change content files</legend>
    					<?php
    					
    					include ("../DatabaseFunctions.php");
    					$pdo = connectToServer ( "mysql:host=localhost;port=3307", "root", "usbw" );
    					selectDatabase ( $pdo, "omega" );
    					
// 							$txtfiles = array (
// 									'home',
// 									'about',
// 									'product',
// 									'workshops' 
// 							);
							
							$array = array();
							
							$query = $pdo->prepare("SELECT titel FROM pagina");
							$query->execute();
							
							while($row = $query->fetch()){
								array_push($array, $row['titel']);
							}
							
// 							print_r($array);
							
							foreach ( $array as $file ) {
								echo "<input type='submit' name='toChange' value='$file'><br>";
							}
							
						?>
    			</form>
    			<form class="addPage" action="addPage.php" method=get>
    				<legend>Nieuwe pagina toevoegen</legend>
    				<input type=text placeholder="Pagina naam" name=pagina><br>
    				<input type=submit value="Maak pagina">
    			</form>
    				<?php
						
						
						if (isset ( $_GET ['toChange'] )) {
							$toChange = $_GET ['toChange'];
							$test = fetchWithException ( $pdo, 'pagina', 'tekst', "titel='$toChange'" );
						}
						
						header ( 'Content-Type: text/html; charset=ISO-8859-1' );
						if (isset ( $_GET ['toChange'] )) {
							$toChange = '';
							$toChange = $_GET ['toChange'];
							echo "<form action=Bewerk.php method=get class=BewerkForm>";
							echo "<textarea id=mytextarea name=Bewerk>$test</textarea><br>";
							echo "<input type='submit' value='Bewerk' class='cmsBewerk'>";
							echo "<input type='hidden' name=toChange value=" . $toChange . ">";
							echo "</form>";
						}
						
						// header ( 'Content-Type: text/html; charset=ISO-8859-1' );
						// if (isset ( $_GET ['toChange'] )) {
						// $toChange = "";
						// $toChange = $_GET ['toChange'];
						// echo "<form action='Bewerk.php' method='GET'>";
						// echo "<textarea class='cmsTextarea' name='Bewerk'>" . $test . "</textarea><br>";
						// echo "<input type='submit' value='Bewerk' class='cmsBewerk'>";
						// echo "<input type='hidden' name=toChange value=" . $toChange . ">";
						// echo "</form>";
						// }
						
						if (isset ( $_GET ['Bewerkt'] )) {
							if ($_GET ['Bewerkt']) {
								echo '<div class="bewerkSuccess">Bestand succesvol bijgewerkt</div>';
							}
						}
						
						// $rows=$_GET['rows'];
						// echo $rows;
						
						?>
    		</div>
			<div class="contentRight">
				<iframe src="http://localhost:8080/bezoekerssite/index.php?page=<?php 
					if(isset($toCHange)){
						echo $toChange;
					}else{
						echo 'home';
					}?>"></iframe>
			</div>
		</div>
	</body>
</html>

