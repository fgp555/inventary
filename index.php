<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="style_table.css?003"> -->
    <?php
    $style_version = date('ymdHi'); // Generate style version based on month, day, and hour
    $style_url = 'style_table.css?v=' . $style_version;
    ?>

    <link rel="stylesheet" type="text/css" href="<?php echo $style_url; ?>">

    <title>Inventory</title>
</head>

<body>
    <?php require "nav.php"; ?>


    <?php
    // Database connection details
    $server = "localhost";
    $user = "fgpooswu_inventory_user";
    $password = "p4s5w0rd_com";
    $database = "fgpooswu_inventory_db";

    try {
        // Create a new PDO instance
        $pdo = new PDO("mysql:host=$server;dbname=$database", $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Get all tables in the database
        $stmtTables = $pdo->query("SHOW TABLES");
        $tables = $stmtTables->fetchAll(PDO::FETCH_COLUMN);

        // Initialize total quantity variables
        $totalQuantityAllTables = 0;

        // Iterate over tables
        foreach ($tables as $table) {
            echo "<h3>$table</h3>";

            // Get data from the current table
            $stmtData = $pdo->query("SELECT id, lot, quantity, DATE_FORMAT(birth, '%m / %d / %Y') AS formatted_birth FROM $table");
            $data = $stmtData->fetchAll(PDO::FETCH_ASSOC);

            // Initialize total quantity for the current table
            $totalQuantityCurrentTable = 0;

            // Display the data in a table
            echo "<table>";
            echo "<tr><th>ID</th><th>Lot</th><th>#</th><th>Birth</th><th>Age</th></tr>";

            foreach ($data as $row) {
                $id = $row['id'];
                $lot = $row['lot'];
                $quantity = $row['quantity'];
                $formattedBirth = $row['formatted_birth'];

                // Calculate age
                $birthDate = DateTime::createFromFormat('m / d / Y', $formattedBirth);
                $currentDate = new DateTime();
                $ageInterval = $birthDate->diff($currentDate);

                $years = $ageInterval->format('%y');
                $months = $ageInterval->format('%m');
                $days = $ageInterval->format('%d');

                $age = "";
                if ($years > 0) {
                    $age .= $years . "y ";
                }
                if ($months > 0) {
                    $age .= $months . "m ";
                }
                if ($days > 6) {
                    $weeks = floor($days / 7); // Convert days to weeks
                    $age .= $weeks . "w ";
                } elseif ($days > 0) {
                    $age .= $days . "d ";
                }

                echo "<tr><td>$id</td><td>$lot</td><td>$quantity</td><td>$formattedBirth</td><td>$age</td></tr>";

                // Sum quantity for the current table
                $totalQuantityCurrentTable += $quantity;
            }

            echo "</table>";

            // Display total quantity for the current table
            echo "<h4>Total $table: $totalQuantityCurrentTable</h4><hr>";

            // Add the current table's total quantity to the total quantity of all tables
            $totalQuantityAllTables += $totalQuantityCurrentTable;
        }

        // Display total quantity for all tables
        echo "<h1 class='sumTotal'>Total: $totalQuantityAllTables</h1>";
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    ?>

    <!-- ========== hide_topbar... ========== -->
    <style>
        .hidden {
            display: none;
        }
    </style>
    <script>
        let html = document.documentElement
        let topbar = document.querySelector(".topbar")

        html.ondblclick = () => {
            topbar.classList.toggle("hidden")
        }
    </script>
    <!-- ========== hide_topbar. ========== -->

</body>

</html>