<?php
function connectToServer($server, $user, $pass) {
	return new PDO ( $server, $user, $pass );
}
function selectDatabase($pdo, $db) {
	$pdo->exec ( "use $db" );
}
function fetchFromDatabase($pdo, $table, $data, $style) {
	$query = $pdo->prepare ( "SELECT $data FROM $table" );
	$query->execute ();
	
	echo "<div class=$style>";
	while ( $row = $query->fetch () ) {
		$value = $row [$data];
		echo $value . "<br>";
	}
	echo "</div>";
}
function fetchWithException($pdo, $table, $data, $exception, $style) {
	$query = $pdo->prepare ( "SELECT $data FROM $table WHERE $exception" );
	$query->execute ();
	
	echo "<div class=$style>";
	while ( $row = $query->fetch () ) {
		$value = $row [$data];
		echo $value . "<br>";
	}
	echo "</div>";
}
function fetchRows($pdo, $table, $data, $style) {
//     for($i = 0; $i < count($data); $i++){
//         $value = $data[$i];
//         $query = $pdo->prepare("SELECT $value FROM $table");
//         $query->execute();
//         $returnvalues = array();
        
//         while($row = $query->fetch()){
//             array_push($returnvalues, $row[$value]);
            
//         }
//         return $returnvalues;
//     }
    
   	$select = "";
   	foreach($data as $fetch){
   		$select .= $fetch . ",";
   	}
   	$select = rtrim($select, ",");
   	
   	$query = $pdo->prepare("SELECT $select FROM $table");
   	$query->execute();
   	$returnvalues = array();
   	
   	while($row = $query->fetch()){
   		for($i = 0; $i < count($data); $i++){
   			$value = $row[$data[$i]];
   			array_push($returnvalues,$value);
   		}
   	}
   	return $returnvalues;
}









