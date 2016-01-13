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
				plugins: 'autoresize',
				plugins: 'link',
				menubar: 'insert',
				height: 300
			});
		</script>
		<title>CMS</title>
	</head>
	<body>
		<div class="banner">
    		<a href="../bezoekerssite/index.php"><img src="../bezoekerssite/img/dynamiek_logo.png" alt="Dynamiek Logo"></a>
    		<h1>Dynamiek Ateliers Login Portaal</h1>
    		<div class=nav>
    			<div class=button><a href=inventaris.php>Voorraad</a></div>
    			<div class="button active"><a href=CMS.php>CMS</a></div>
    			<div class=button><a href=gebruikersbeheer.php>Gebruikersbeheer</a></div>
    		</div>
    		<div class="LoggedInUser"><?php 
    			session_start();
    			$user = $_SESSION['user'];					//Get current user
    			print("<p>".$user."</p>");
    			?>
    			<a href="login.php" class=logoutbutton>Log uit</a>
    		</div>
    	</div>
		<div class="contents">
			<div class="contentLeft">
				<form class="cmsSelect" method='GET' action="CMS.php">
					<legend>Change content files</legend>
					<table border=0>
						<tr><th></th><th>Verwijder pagina</th></tr>
    					<?php
    					
    					include ("../DatabaseFunctions.php");
    					$pdo = connectToServer ( "mysql:host=178.62.201.206;port=3306", "omega", "usbw" );	//
    					selectDatabase ( $pdo, "omega" );												//Connect to database
    					
    					if(isset($_SESSION['user'])){													//Check if user is logged in
    						if(checkUserLevel($pdo, $user) == 1){										//Check user level
    					
    						}else{
    							header('Location: login.php');											//Redirect if insufficient permissions
    						}
    					}else{
    						header('Location: login.php');												//Redirect if no user logged in
    					}
    					
    					if(isset($_GET['Delete'])){														//Check if we're deleting pages
    						if(isset($_GET['Verwijder'])){												//Check which page to delete
    							$query = "DELETE FROM `pagina` WHERE `Pagina ID` = ?";					//Prepare query
//     							echo $query;
    							$query = $pdo->prepare($query);											//
    							$query->execute(array($_GET['Verwijder']));								//Delete page
    						}else{
    							
    						}
    					}else{
    						
    					}
    				
							$array = array();															//Create array
							$query = $pdo->prepare("SELECT * FROM pagina");								//Prepare query
							$query->execute();															//Fetch pages
							
							while($row = $query->fetch()){
								$array[$row['Pagina ID']] = $row['Titel'];								//Fetch page titles
							}
							
// 							print_r($array);
							
							foreach ( $array as $ID => $file) {												//Loop through array of page titles
								echo "<tr><td><input type='submit' name='toChange' value='$file'></td>";	//Make button
								echo "<th><input type='radio' name='Verwijder' value='$ID'></th></tr>";		//Make delete selector button
							}
// 							echo $_GET['Verwijder'];
							
						?>
						<tr><td></td><th><input type=submit value=Verwijder name=Delete></th></tr>
					</table>
    			</form>
    			<form class="addPage" action="addPage.php" method=get>
    				<legend>Nieuwe pagina toevoegen</legend>
    				<input type=text placeholder="Pagina naam" name=pagina><br>
    				<input type=submit value="Maak pagina"><br>
    				Om tussen pagina's te linken moet de Url beginnen met '?page='
    			</form>
    				<?php
						
						
						if (isset ( $_GET ['toChange'] )) {
							$toChange = $_GET ['toChange'];																	//
							$test = fetchWithException ( $pdo, 'pagina', 'tekst', "titel='$toChange'" );					//
						}
						
						header ( 'Content-Type: text/html; charset=ISO-8859-1' );											//Set right character set
						if (isset ( $_GET ['toChange'] )) {																	//Check if we're changing text
							$toChange = '';																					//Reset the text to cange
							$toChange = $_GET ['toChange'];																	//Get the text to change
							echo "<form action=Bewerk.php method=get class=BewerkForm>";									//Create form
							echo "<div class=WYSIWYG><textarea id=mytextarea name=Bewerk>$test</textarea></div><br>";		//Create text editor. Put in text from page
							echo "<input type='submit' value='Bewerk' class='cmsBewerk'>";									//Create submit button
							echo "<input type='hidden' name=toChange value=" . $toChange . ">";								//Create hidden value for text changed
							echo "</form>";																					//
						}
						
						// header ( 'Content-Type: text/html; charset=ISO-8859-1' );
						// if (isset ( $_GET ['toChange'] )) {
						// $toChange = "";
						// $toChange = $_GET ['toChange'];
						// echo "<form action='Bewerk.php' method='GET'>";
						// echo "<textarea class='cmsTextarea' name='Bewerk'>" . $test . "</textarea><br>";						OLD SYSTEM
						// echo "<input type='submit' value='Bewerk' class='cmsBewerk'>";
						// echo "<input type='hidden' name=toChange value=" . $toChange . ">";
						// echo "</form>";
						// }
						
						if (isset ( $_GET ['Bewerkt'] )) {
							if ($_GET ['Bewerkt']) {
								echo '<div class="bewerkSuccess">Bestand succesvol bijgewerkt</div>';						//Check if page was edited
							}
						}
						
						// $rows=$_GET['rows'];
						// echo $rows;
						
						?>
    		</div>
			<div class="contentRight">
				<iframe height=100% src="../bezoekerssite/index.php?page=<?php 
					if(isset($toChange)){
						echo $toChange;
					}else{
						echo 'home';
					}?>"></iframe>
			</div>
		</div>
	</body>
</html>

