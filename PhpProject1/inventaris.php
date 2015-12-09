<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=${encoding}">
<title>Inventaris</title>
<link type="text/css" rel="stylesheet" src="bootstrap.css">
</head>
    <body>
    <?php
    //debug stuff
    session_start();
    //functions
    include('DatabaseFunctions.php');
    
    function Inv_Plus($InvID) {
    	try {
    		$pdo = connectToServer ( "mysql:host=localhost;port=3307", "root", "usbw" );
    		selectDatabase ( $pdo, "omega" );
    	} catch (Exception $e) {
    		echo 'Caught exception: ',  $e->getMessage(), "\n";
    	}
    	$stmt = $pdo->prepare("UPDATE inventaris SET beschikbaarheid + 1 WHERE Productnummer=$InvID");
    	$stmt->execute();
    }
    
    function Inv_Min($InvID) {
    	 
    }
    
    function Inv_Del($InvID) {
    	
    }
    //Importeer bestanden
    
	//connect met database

    
    $pdo = connectToServer ( "mysql:host=localhost;port=3307;", "root", "usbw" );
    selectDatabase ( $pdo, "omega" );
    
    $query = $pdo->prepare("SELECT * FROM inventaris");
    $query->execute();
    $array = array();
    
    while($row = $query->fetch()){
    	$productnummer = $row['Productnummer'];
    	$product = $row['Product'];
    	$beschrijving = $row['Product'];
    	$beschikbaar = $row['Beschikbaarheid'];
    	$webshopurl = $row['WebshopURL'];
    	$imageurl = $row['ImageURL'];
    	
    	print ("<img src='".$imageurl."' /> <br>");
    	print ("Productnummer: " . $productnummer . "<br>");
    	print ("Naam: ". $product . "<br>");
    	
    	print ("Aantal beschikbaar: " . $beschikbaar . "<br>");
    	print ('<a href="" onclick='. Inv_Plus($productnummer) .' class="plusbtn">plusbtn</a>  ');
    	print ('<a href="" onclick='. Inv_Min($productnummer) .' class="plusbtn">minbtn</a><br />');
    	print ('<a href="" onclick='. Inv_Del($productnummer) .' class="plusbtn">Verwijderen</a><br />');
    	
    	print ("<br>");
    }
    
	
	?>
    </body>
</html>