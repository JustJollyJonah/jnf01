<?php
// sessie start
session_start ();
// $user = $_SESSION['user'];

// Database connectie
$pdo = connectToServer ( "mysql:host=localhost;port=3307;", "root", "usbw" );
selectDatabase ( $pdo, "omega" );