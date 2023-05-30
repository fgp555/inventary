<?php
require "00_connection.php";


// Check if the insert button is clicked
$message = "";
if (isset($_POST['insert'])) {
    // Generate random data
    $lot = generateRandomString(5);
    $quantity = rand(1, 100);
    $birth = generateRandomDate();

    // SQL query to insert data
    $sql = "INSERT INTO $table ($column1, $column2, $column3) VALUES ('$lot', $quantity, '$birth')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        $message = "Data inserted successfully.";
    } else {
        $message = "Error inserting data: " . $conn->error;
    }
}

// Function to generate random string
function generateRandomString($length = 10) {
    $characters = 'abcdABCD1234';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

// Function to generate random date
function generateRandomDate() {
    $start = strtotime("1950-01-01");
    $end = strtotime("2000-12-31");
    $randomTimestamp = mt_rand($start, $end);
    $randomDate = date("Y-m-d", $randomTimestamp);
    return $randomDate;
}

// Fetch data from the table
$result = $conn->query("SELECT * FROM $table");
?>

<!-- HTML form with button -->
<form method="POST">
    <input type="submit" name="insert" value="Insert random data">
</form>
<?php echo $message; ?>
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
