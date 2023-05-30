<?php
$server = "localhost";
$user = "fgpooswu_inventory_user";
$password = "p4s5w0rd_com";
$database = "fgpooswu_inventory_db";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $table = $_POST['table'];
    $column0 = $_POST['column0'];
    $column1 = $_POST['column1'];
    $column2 = $_POST['column2'];
    $column3 = $_POST['column3'];

    // Create a connection
    $conn = new mysqli($server, $user, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to create the table
    $sql = "CREATE TABLE $table (
        $column0 INT(11) PRIMARY KEY AUTO_INCREMENT,
        $column1 VARCHAR(255),
        $column2 INT(11),
        $column3 DATE
    )";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Table created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Table</title>
</head>
<body>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="table">Table Name:</label>
        <input type="text" name="table" id="table" value="table" required><br><br>

        <label for="column0">Column 0:</label>
        <input type="text" name="column0" id="column0" value="id" required><br><br>

        <label for="column1">Column 1:</label>
        <input type="text" name="column1" id="column1" value="lot" required><br><br>

        <label for="column2">Column 2:</label>
        <input type="text" name="column2" id="column2" value="quantity" required><br><br>

        <label for="column3">Column 3:</label>
        <input type="text" name="column3" id="column3" value="birth" required><br><br>

        <input type="submit" value="Create Table">
    </form>
</body>
</html>
