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
    			<div class=button><a href=Gebruikersbeheer.php>Gebruikersbeheer</a></div>
    		</div>
    		<div class="LoggedInUser"><?php 
    			session_start();															//
    			$user = $_SESSION['user'];													//Check current user		
    			echo $user;																	//
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
    				if(isset($_POST['tekst'])){												//
    					echo $_POST['tekst'];												//Put text back in editor if page was already added
    				}																		//
    				?></textarea><br>
    			</div>
    			<input type="submit" value="Maak pagina" name=Add>
    		</form>
    		<?php 
	
			include ("../DatabaseFunctions.php");
			$pdo = connectToServer ( "mysql:host=178.62.201.206;port=3306", "omega", "usbw" );	//
			selectDatabase ( $pdo, "omega" );												//Connect to database
			
			if(isset($_SESSION['user'])){													//Check if user is logged in
				if(checkUserLevel($pdo, $user) == 1){										//Check user level
																							//
				}else{																		//
					header('Location: login.php');											//Send unauthorized users back
				}																			//
			}else{																			//
				header('Location: login.php');												//Send non-logged in users back
			}
	
			if(isset($_POST['Add'])){														//
				$submit = $_POST['Add'];													//Check if adding page
			}else{																			//
					
			}
	
			if(isset($submit)){																//Check if adding page
// 				echo $submit;
				$query = $pdo->prepare("INSERT INTO pagina (Titel,Beschrijving,Tekst,Actief,Versie) VALUES (?,?,?,?,?)");		//Insert new page into database
				$query->execute(array($_GET['pagina'],$_POST['Beschrijving'],$_POST['tekst'],'0','1'));							//Insert values
// 				echo $query->rowCount();
			}
	
			?>
			<a href=CMS.php>Terug naar het CMS</a>
    	</div>
	</body>
</html>