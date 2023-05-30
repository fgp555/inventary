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

// Fetch data from the table
$result = $conn->query("SELECT * FROM $table");
?>

<!-- HTML table to display the data -->
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
            echo "<td>" . $row[$column0] . "</td>";
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

<?php
// Close the connection
$conn->close();
?>
