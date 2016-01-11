<?php

// Database connectie
$pdo = connectToServer ( "mysql:host=178.62.201.206;port=3306;", "omega", "usbw" );
selectDatabase ( $pdo, "omega" );