    <?php
    //Importeer bestanden
    include 'DatabaseFunctions.php';
	//connect met database
    try {
    $pdo = connectToServer ( "mysql:host=localhost;port=3307", "root", "usbw" );
    selectDatabase ( $pdo, "omega" );
    } catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
    
    $stmt = $pdo->prepare("SELECT * FROM inventaris");
    $stmt->execute();
    $array = array();
    
    while($row = $stmt->fetch()){
    	$productnummer = $row['Productnummer'];
    	$product = $row['Product'];
    	$beschrijving = $row['Product'];
    	$beschikbaar = $row['Beschikbaarheid'];
    	$webshopurl = $row['WebshopURL'];
    	$imageurl = $row['ImageURL'];
    	
    	print ("<img src='".$imageurl."' /> <br>");
    	print ("Product nummer: " . $productnummer . "<br>");
    	print ("Naam: ". $product . "<br>");
    	
    }
    
	
	?>
