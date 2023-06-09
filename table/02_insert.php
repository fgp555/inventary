<?php
require "00_connection.php";


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
                    <input type="text" name="lot" placeholder="Enter Lot" value="<?php echo basename(__DIR__); ?>" required>
                </td>
                <td>
                    <input type="number" name="quantity" placeholder="Enter Quantity" value="2" required>
                </td>
                <td>
                    <input type="date" name="birth" value="2023-05-09" required>
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
