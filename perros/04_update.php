<?php
require "00_connection.php";


// Check if form is submitted (for data update)
if (isset($_POST['update_id'])) {
    $id = $_POST['update_id'];
    $lot = $_POST['lot'];
    $quantity = $_POST['quantity'];
    $birth = $_POST['birth'];

    // Update data in the table
    $sql = "UPDATE $table SET $column1='$lot', $column2='$quantity', $column3='$birth' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Data updated successfully.";
    } else {
        echo "Error updating data: " . $conn->error;
    }
}

// Fetch data from the table
$result = $conn->query("SELECT * FROM $table");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Display and Update Data</title>
</head>
<body>
    <h2>Data in Table</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Lot</th>
            <th>Quantity</th>
            <th>Birth</th>
            <th>Action</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row[$column1] . "</td>";
                echo "<td>" . $row[$column2] . "</td>";
                echo "<td>" . $row[$column3] . "</td>";
                echo "<td>";
                echo "<button onclick=\"editRow(" . $row['id'] . ", '" . $row[$column1] . "', " . $row[$column2] . ", '" . $row[$column3] . "')\">Edit</button>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No data found.</td></tr>";
        }
        ?>
    </table>

    <h2>Modify Data</h2>
    <form method="post" action="">
        <style>
            form {
                display: flex;
            }
        </style>
        <input type="hidden" id="update_id" name="update_id">
        <!-- <label for="lot">Lot:</label> -->
        <input type="text" id="edit_lot" name="lot" placeholder="Enter Lot" required><br><br>

        <!-- <label for="quantity">Quantity:</label> -->
        <input type="number" id="edit_quantity" name="quantity" placeholder="Enter Quantity" required><br><br>

        <!-- <label for="birth">Birth:</label> -->
        <input type="date" id="edit_birth" name="birth" required><br><br>

        <input type="submit" name="submit" value="Update">
    </form>

    <script>
        function editRow(id, lot, quantity, birth) {
            document.getElementById('update_id').value = id;
            document.getElementById('edit_lot').value = lot;
            document.getElementById('edit_quantity').value = quantity;
            document.getElementById('edit_birth').value = birth;
        }
    </script>
</body>
</html>

<?php
// Close the connection
$conn->close();
?>
