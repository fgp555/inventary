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

// Function to delete a row from the table
function deleteRow($id) {
    global $conn, $table, $column0;

    $id = $conn->real_escape_string($id);

    $sql = "DELETE FROM $table WHERE $column0 = '$id'";
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

// Check if delete button is clicked
if (isset($_POST['delete_id'])) {
    $deleteID = $_POST['delete_id'];
    $deleteResult = deleteRow($deleteID);
    if ($deleteResult) {
        echo "Row deleted successfully.";
    } else {
        echo "Error deleting row.";
    }
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
        <th>Action</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row[$column0] . "</td>";
            echo "<td>" . $row[$column1] . "</td>";
            echo "<td>" . $row[$column2] . "</td>";
            echo "<td>" . $row[$column3] . "</td>";
            echo "<td><button onclick='deleteRow(" . $row[$column0] . ")'>Delete</button></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No data found.</td></tr>";
    }
    ?>
</table>

<script>
    function deleteRow(id) {
        // var confirmed = confirm("Are you sure you want to delete this row?");
        var confirmed = true;
        if (confirmed) {
            var form = document.createElement("form");
            form.setAttribute("method", "post");
            form.setAttribute("action", "");
            
            var deleteID = document.createElement("input");
            deleteID.setAttribute("type", "hidden");
            deleteID.setAttribute("name", "delete_id");
            deleteID.setAttribute("value", id);
            
            form.appendChild(deleteID);
            document.body.appendChild(form);
            
            form.submit();
        }
    }
</script>

<?php
// Close the connection
$conn->close();
?>
