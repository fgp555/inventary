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

$message = "";

// Check if the create button is clicked
if (isset($_POST['create'])) {
    // Create a connection
    $conn = new mysqli($server, $user, $password);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to create the database
    $sql = "CREATE DATABASE $database";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        $message = "Database created successfully.";
    } else {
        $message = "Error creating database: " . $conn->error;
    }

    // Close the connection
    $conn->close();
}

// Check if the delete button is clicked
if (isset($_POST['delete'])) {
    // Create a connection
    $conn = new mysqli($server, $user, $password);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to drop the database
    $sql = "DROP DATABASE $database";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        $message = "Database deleted successfully.";
    } else {
        $message = "Error deleting database: " . $conn->error;
    }

    // Close the connection
    $conn->close();
}

// Display all databases
$conn = new mysqli($server, $user, $password);
$result = $conn->query("SHOW DATABASES");

if ($result->num_rows > 0) {
    echo "Databases:<br>";
    while ($row = $result->fetch_assoc()) {
        echo $row["Database"] . "<br>";
    }
} else {
    echo "No databases found.";
}

// Close the connection
$conn->close();

echo "<br>";
?>

<!-- HTML form with buttons -->

<form method="POST">
    <input type="submit" name="create" value="Create" style="color: green;">
    <label for=""> <?php echo $database; ?></label>
</form>

<form method="POST">
    <input type="submit" name="delete" value="Delete" style="color: red;">
    <label for=""> <?php echo $database; ?></label>
</form>

<?php echo $message; ?>