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
    		
    		include ("DatabaseFunctions.php");
    		include ("CustomEncryption.php");
    		
    		$test = Encrypt("test");
    		$test2 = Encrypt("test");
    		print_r($test);
    		echo "</br>";
//     		print_r($test2);
    		
    		?>
    			<form method="POST" action="login.php">
    				Gebruikersnaam: <input type="text" name="username"><br><br>
    				Wachtwoord: <input type="password" name="password"><br>
    				<input type="submit" value="submit" id="submit">
    			</form>
    		</div>
    	</div>
    </body>
</html>