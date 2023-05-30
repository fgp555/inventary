<?php

date_default_timezone_set('America/Lima');
date('F d, Y'); 
// Database connection details
$prefix = "fgpooswu_";

$server = "localhost";
$user = $prefix ."inventory_user";
$password = "p4s5w0rd_com";
$database = $prefix ."inventory_db";


// Create a connection
$conn = new mysqli($server, $user, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
