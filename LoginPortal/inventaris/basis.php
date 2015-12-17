<?php

// Database connectie
$pdo = connectToServer ( "mysql:host=localhost;port=3307;", "root", "usbw" );
selectDatabase ( $pdo, "omega" );