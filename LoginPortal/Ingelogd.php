<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="StylePortal.css">
<link rel="stylesheet" href="cmsStyle.css">
<title>Insert title here</title>
</head>
    <body>
    	<div class="banner">
    		<img src="" alt="Hier komt het logo">
    		<p>Dynamiek Ateliers Login Portaal</p>
    		<div class="LoggedInUser"><?php session_start();
    		$user = $_SESSION['user'];
    		echo $user;?></div>
    	</div>
    	<div class="contentLeft">
    		<form class="cmsSelect" method='GET' action="Ingelogd.php">
    		<legend>Change content files</legend>
    			<?php 
    			$txtfiles = array('home','about','product','workshops');
    		
    			foreach($txtfiles as $file){
    				echo "<input type='submit' name='toChange' value='$file'><br>";
    			}
    			
    			
    			?>
    		</form>
    		<?php 
    		header ( 'Content-Type: text/html; charset=ISO-8859-1' );
    		if(isset($_GET['toChange'])){
				$toChange = "";
    			$toChange = "../PhpProject1/" . $_GET['toChange'];
    			echo "<form action='Bewerk.php' method='GET'>";
    			echo "<textarea class='cmsTextarea' name='Bewerk'>" . file_get_contents($toChange) . "</textarea><br>";
    			echo "<input type='submit' value='Bewerk' class='cmsBewerk'>";
    			echo "<input type='hidden' name=toChange value=" . $toChange . ">";
    			echo "</form>";
    		}
    		
    		if(isset($_GET['Bewerkt'])){
    			if($_GET['Bewerkt']){
    				echo '<div class="bewerkSuccess">Bestand succesvol bijgewerkt</div>';
    			}
    		}
    		
    		?>
    	</div>
    	<div class="contentRight">
    		<iframe src="http://localhost:8080/jnf01/PhpProject1/indexLayout3.php"></iframe>
    	</div>
    </body>
</html>