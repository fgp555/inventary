<!DOCTYPE html>
<html>

<head>
    <title>Database Information</title>
    <style>
        * {
            box-sizing: border-box;
        }
        .collapsible {
            cursor: pointer;
            padding: 0.3em;
            width: 100%;
            border: none;
            text-align: left;
            outline: none;
            background-color: #88f;
            font-size: 16px;
        }

        .content {
            padding: 0 18px;
            display: none;
            overflow: hidden;
            background-color: #ffffff;
        }
    </style>

</head>

<body>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $servername = $_POST['servername'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $database = $_POST['database'];

        // Create a connection
        $conn = new mysqli($servername, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Display databases
        $sqlDatabases = "SHOW DATABASES";
        $resultDatabases = $conn->query($sqlDatabases);

        if ($resultDatabases->num_rows > 0) {
            echo "<h2>Databases:</h2>";
            echo "<ul>";
            while ($row = $resultDatabases->fetch_assoc()) {
                $databaseName = $row['Database'];
                echo "<li class='collapsible'>$databaseName</li>";

                // Display tables and columns within each database
                $sqlTables = "SHOW TABLES FROM $databaseName";
                $resultTables = $conn->query($sqlTables);

                if ($resultTables->num_rows > 0) {
                    echo "<div class='content'>";
                    echo "<ul>";
                    while ($rowTable = $resultTables->fetch_assoc()) {
                        $tableName = $rowTable["Tables_in_$databaseName"];
                        echo "<li class='collapsible'>$tableName</li>";


                        $sqlColumns = "SHOW COLUMNS FROM $databaseName.$tableName";
                        $resultColumns = $conn->query($sqlColumns);

                        if ($resultColumns->num_rows > 0) {
                            echo "<div class='content'>";
                            echo "<ul>";
                            while ($rowColumn = $resultColumns->fetch_assoc()) {
                                $columnName = $rowColumn['Field'];
                                echo "<li>$columnName</li>";
                            }
                            echo "</ul>";
                            echo "</div>";
                        }
                    }
                    echo "</ul>";
                    echo "</div>";
                }
            }
            echo "</ul>";
        } else {
            echo "No databases found.";
        }

        // Close the connection
        $conn->close();
    }
    ?>

    <form method="POST">
        <label for="servername">Server Name:</label>
        <input type="text" id="servername" name="servername" value="localhost" required><br><br>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="root" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" value=""><br><br>

        <label for="database">Database Name:</label>
        <input type="text" id="database" name="database" value="database00" required><br><br>

        <input type="submit" name="submit" value="Connect">
    </form>
    <script>
        var coll = document.getElementsByClassName("collapsible");
        var i;

        for (i = 0; i < coll.length; i++) {
            coll[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var content = this.nextElementSibling;
                if (content.style.display === "block") {
                    content.style.display = "none";
                } else {
                    content.style.display = "block";
                }
            });
        }
    </script>
</body>

</html>