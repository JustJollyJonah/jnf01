<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" href="StylePortal.css">
		<link rel="stylesheet" href="cmsStyle.css">
		<script src="WYSIWYG\tinymce\js\tinymce\tinymce.min.js"></script>
		<title>Insert title here</title>
		<script>
			tinymce.init({
				selector: '#mytextarea',
				plugins: 'autoresize'
			});
		</script>
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
    	
    	<div class="content">
    		<form method=post class=pageAdd>
    			<?php echo "<h1>" . $_GET['pagina'] . "</h1>"?>
    			<input type=text placeholder=Beschrijving name=Beschrijving><br>
    			<div class=pageContents>
    				<textarea id=mytextarea name=tekst><?php 
    				if(isset($_POST['tekst'])){
    					echo $_POST['tekst'];
    				}
    				?></textarea><br>
    			</div>
    			<input type="submit" value="Maak pagina" name=Add>
    		</form>
    		<?php 
	
			include ("../DatabaseFunctions.php");
			$pdo = connectToServer ( "mysql:host=localhost;port=3307", "root", "usbw" );
			selectDatabase ( $pdo, "omega" );
			
			if(isset($_SESSION['user'])){
				if(checkUserLevel($pdo, $user) == 1){
						
				}else{
					header('Location: login.php');
				}
			}else{
				header('Location: login.php');
			}
	
			if(isset($_POST['Add'])){
				$submit = $_POST['Add'];
			}else{
					
			}
	
			if(isset($submit)){
// 				echo $submit;
				$query = $pdo->prepare("INSERT INTO pagina (Titel,Beschrijving,Tekst,Actief,Versie) VALUES (?,?,?,?,?)");
				$query->execute(array($_GET['pagina'],$_POST['Beschrijving'],$_POST['tekst'],'0','1'));
// 				echo $query->rowCount();
			}
	
			?>
			<a href=CMS.php>Terug naar het CMS</a>
    	</div>
	</body>
</html>