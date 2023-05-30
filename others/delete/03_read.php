<?php
require "00_connection.php";


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
