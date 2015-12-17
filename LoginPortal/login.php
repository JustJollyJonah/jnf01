<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="StylePortal.css">
<title>Insert title here</title>
</head>
    <body>
    	<div class="banner">
    		<img src="" alt="Hier komt het logo">
    		<p>Dynamiek Ateliers Login Portaal</p>
    	</div>
    	<div class="content">
    	
    		<div class="loginform">
	    	<?php 
	    	session_start();
	    	session_destroy();
	    	include ("../DatabaseFunctions.php");
	    	include ("CustomEncryption.php");
    		
    		$pdo = connectToServer ( "mysql:host=localhost;port=3307;", "root", "usbw" );
    		selectDatabase($pdo, 'omega');
    		
    		?>
    			<form method="POST" action="checklogin.php">
    			<?php 
    			
    			if(isset($_SESSION['falseLogin'])){
    				if($_SESSION['falseLogin']){
    					echo '<div id="error">False Login</div>';
    				}
    			}
    			
    			?>
    				Gebruikersnaam: <input type="text" name="username"><br><br>
    				Wachtwoord: <input type="password" name="password"><br>
    				<input type="submit" value="submit" id="submit">
    			</form>
    		</div>
    	</div>
    </body>
</html>