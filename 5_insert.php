<?php
// Database connection details
$server = "localhost";
$user = "fgpooswu_inventory_user_00";
$password = "p4s5w0rd_com";
$database = "fgpooswu_inventory_00";
$table = "table00";
$column1 = "lot"; // VARCHAR
$column2 = "quantity"; // INT
$column3 = "birth"; // DATE

// Create a connection
$conn = new mysqli($server, $user, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if (isset($_POST['submit'])) {
    $lot = $_POST['lot'];
    $quantity = $_POST['quantity'];
    $birth = $_POST['birth'];

    // Insert data into the table
    $sql = "INSERT INTO $table ($column1, $column2, $column3) VALUES ('$lot', '$quantity', '$birth')";
    if ($conn->query($sql) === TRUE) {
        echo "Data inserted successfully.";
    } else {
        echo "Error inserting data: " . $conn->error;
    }
}

// Fetch data from the table
$result = $conn->query("SELECT * FROM $table");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Insert Data</title>
</head>
<body>
    <h2>Insert Data</h2>
    <table>
        <tr>
            <th>Lot</th>
            <th>Quantity</th>
            <th>Birth</th>
            <th>Action</th>
        </tr>
        <tr>
            <form method="post" action="">
                <td>
                    <input type="text" name="lot" placeholder="Enter Lot" required>
                </td>
                <td>
                    <input type="number" name="quantity" placeholder="Enter Quantity" required>
                </td>
                <td>
                    <input type="date" name="birth" required>
                </td>
                <td>
                    <input type="submit" name="submit" value="Submit">
                </td>
            </form>
        </tr>
    </table>

    <h2>Data in Table</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Lot</th>
            <th>Quantity</th>
            <th>Birth</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row[$column1] . "</td>";
                echo "<td>" . $row[$column2] . "</td>";
                echo "<td>" . $row[$column3] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No data found.</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
// Close the connection
$conn->close();
?>
