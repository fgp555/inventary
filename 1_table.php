<?php
// Database connection details
$server = "localhost";
$user = "fgpooswu_inventory_user_00";
$password = "p4s5w0rd_com";
$database = "fgpooswu_inventory_00";
$table = "table00";
$column0 = "id"; // INT / primary key / auto-increment
$column1 = "lot"; // VARCHAR
$column2 = "quantity"; // INT
$column3 = "birth"; // DATE

// Create a connection
$conn = new mysqli($server, $user, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the create button is clicked
if (isset($_POST['create'])) {
    // SQL query to create the table
    $sql = "CREATE TABLE $table (
        $column0 INT PRIMARY KEY AUTO_INCREMENT,
        $column1 VARCHAR(255),
        $column2 INT,
        $column3 DATE
    )";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Table <b>$table</b> created successfully.";
    } else {
        echo "Error creating table: " . $conn->error;
    }

    // ==========  ==========
    // Get the table structure
    $tableInfo = $conn->query("DESCRIBE $table");
    if ($tableInfo) {
        echo "<hr>Table Columns:<br>";
        while ($column = $tableInfo->fetch_assoc()) {
            echo $column['Field'] . "<br>";
        }
    } else {
        echo "Error fetching table columns: " . $conn->error;
    }
    echo "<br>";
}

// Check if the delete button is clicked
if (isset($_POST['delete'])) {
    // SQL query to delete the table
    $sql = "DROP TABLE IF EXISTS $table";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Table deleted successfully.";
    } else {
        echo "Error deleting table: " . $conn->error;
    }
}



// Close the connection
$conn->close();
?>

<!-- HTML form with buttons -->
<form method="POST">
    <input type="submit" name="create" value="Create table">
</form>

<form method="POST">
    <input type="submit" name="delete" value="Delete table">
</form>