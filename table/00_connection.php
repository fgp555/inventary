<?php

require "../00_conn_db.php";

$filename = 'tables.txt';

if (file_exists($filename)) {
    $content = file_get_contents($filename);
    $table = $content;
} else {
    echo 'File does not exist.';
}

// $table = basename(__DIR__);
$column0 = "id"; // INT PRIMARY KEY AUTO_INCREMENT
$column1 = "lot"; // VARCHAR(255)
$column2 = "quantity"; // INT
$column3 = "birth"; // DATE

// Create a connection
$conn = new mysqli($server, $user, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>