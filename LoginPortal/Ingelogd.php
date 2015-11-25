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
    		<?php 
    		session_start();
    		
    		$user = $_SESSION['user'];
    		echo $user;
    		
    		?>
    	</div>
    </body>
</html>