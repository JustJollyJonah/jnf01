<?php

function connectToServer($server, $user, $pass){
    return new PDO($server, $user, $pass);
}

function selectDatabase($pdo, $db){
    $pdo->exec("use $db");
}

function fetchFromDatabase($pdo, $table, $data, $style){
    $query = $pdo->prepare("SELECT $data FROM $table");
    $query->execute();
    
    echo "<div class=$style>";
    while($row = $query->fetch()){
        $value = $row[$data];
        echo $value . "<br>";
    }
    echo "</div>";
}

function fetchWithException($pdo, $table, $data, $exception, $style){
    $query = $pdo->prepare("SELECT $data FROM $table WHERE $exception");
    $query->execute();
    
    echo "<div class=$style>";
    while($row = $query->fetch()){
        $value = $row[$data];
        echo $value . "<br>";
    }
    echo "</div>"; 
}

function fetchMultiple($pdo, $table, $data, $style){
    for($i = 0; $i < count($data); $i++){
        $value = $data[$i];
        $query = $pdo->prepare("SELECT $value FROM $table");
        $query->execute();
        
        echo "<div class=$style>";
        while($row = $query->fetch()){
            $value_ = $row[$value];
            echo $value_ . "<br>";
        }
        echo "</div>";
    }
    
//    for(){
//        
//    }
}