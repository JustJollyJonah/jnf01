<?php

function connectToServer($server, $user, $pass) {
	return new PDO ( $server, $user, $pass );									//Connect to the server
}

function selectDatabase($pdo, $db) {
	$pdo->exec ( "use $db" );													//select database to use
}

function fetchFromDatabase($pdo, $table, $data, $style) {
	$query = $pdo->prepare ( "SELECT $data FROM $table" );						//create new query
	$query->execute ();															//execute query
	$array = array();
	
	while ( $row = $query->fetch () ) {											//fetch result
		$value = $row [$data];
		array_push($array, $value);
		return $array;															//returns array with all values
	}
}

function fetchWithException($pdo, $table, $data, $exception) {
	$query = $pdo->prepare ( "SELECT $data FROM $table WHERE $exception" );		//create new query
	$query->execute ();															//execute query
	
	while ( $row = $query->fetch () ) {											//retch result
		$value = $row [$data];
		return $value;															//returns value
	}
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
    
   	$select = "";																//create select string
   	foreach($data as $fetch){
   		$select .= $fetch . ",";												//create select string
   	}
   	$select = rtrim($select, ",");												//remove , from end of select string
   	
   	$query = $pdo->prepare("SELECT $select FROM $table");						//prepare query
   	$query->execute();															//execute query
   	$returnvalues = array();													//create return array
   	
   	while($row = $query->fetch()){												//loop rows
   		for($i = 0; $i < count($data); $i++){									//loop columns
   			$value = $row[$data[$i]];											//get value
   			array_push($returnvalues,$value);									//push value in return array
   		}
   	}
   	return $returnvalues;														//returns array
}









