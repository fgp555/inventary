<?php

require "../00_conn_db.php";
// Database connection details
// $server = "localhost";
// $user = "fgpooswu_inventory_user_00";
// $password = "p4s5w0rd_com";
// $database = "fgpooswu_inventory_00";
$table = basename(__DIR__);
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