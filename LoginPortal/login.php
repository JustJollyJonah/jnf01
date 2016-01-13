<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="StylePortal.css">
<title>Login Portal</title>
</head>
    <body>
    	<div class="banner">
    		<a href="../bezoekerssite/index.php"><img src="../bezoekerssite/img/dynamiek_logo.png" alt="Dynamiek Logo"></a>
    		<a class="home_button" href="../bezoekerssite/index.php"><img class="homebutton" src="../bezoekerssite/img/home_button.png" alt="Home button"></a>
    	</div>
    	<div class="content">
    		<img class="dynamiek_text" src="../bezoekerssite/img/dynamiek_text.png" alt="Dynamiek Text"></br>
    		<div class="loginform">
	    	<?php 
	    	session_start();
	    	session_destroy();
    		?>
    			<form method="POST" action="checklogin.php">
    			<?php 
    			
    			if(isset($_SESSION['falseLogin'])){
    				if($_SESSION['falseLogin']){
    					echo '<div id="error">False Login</div>';
    				}
    			}
    			
    			?><input type="text" name="username" placeholder="Gebruikersnaam"><br> 
    				<br><input type="password" name="password" placeholder="Wachtwoord"><br>
    				<input type="submit" value="Login" id="submit">
    			</form>
    		</div>
    	</div>
    </body>
</html>