<?php
// Old database
$oldServername = "localhost";
$oldUsername = "fgpooswu_guinea_pig_user";
$oldPassword = "p4s5w0rd_com";
$oldDatabaseName = "fgpooswu_guinea_pig";
$oldTableName = "population";
$oldId = "id";
$oldLote = "lote";
$oldQuantity = "quantity";
$oldBirth = "birth";

// New database
$newServername = "localhost";
$newUsername = "fgpooswu_inventory_user_00";
$newPassword = "p4s5w0rd_com";
$newDatabaseName = "fgpooswu_inventory_00";
$newTableName = "table00";
$newColumn0 = "id"; // INT / primary key / auto-increment
$newColumn1 = "lot"; // VARCHAR
$newColumn2 = "quantity"; // INT
$newColumn3 = "birth"; // DATE

// Step 1: Connect to both databases
$oldDatabase = new mysqli($oldServername, $oldUsername, $oldPassword, $oldDatabaseName);
$newDatabase = new mysqli($newServername, $newUsername, $newPassword, $newDatabaseName);

// Check if the connection to both databases is successful
if ($oldDatabase->connect_errno || $newDatabase->connect_errno) {
    echo 'Failed to connect to databases: ' . $oldDatabase->connect_error . ' / ' . $newDatabase->connect_error;
    exit;
}

// Step 2: Retrieve data from old database > population table
$selectQuery = "SELECT $oldLote, $oldQuantity, $oldBirth FROM $oldTableName";
$result = $oldDatabase->query($selectQuery);

// Check if the query execution was successful
if (!$result) {
    echo 'Error retrieving data from population table: ' . $oldDatabase->error;
    exit;
}

// Step 3: Transform and insert the data into new database > table00
$insertQuery = "INSERT INTO $newTableName ($newColumn1, $newColumn2, $newColumn3) VALUES (?, ?, ?)";
$insertStatement = $newDatabase->prepare($insertQuery);

// Bind parameters for the prepared statement
$insertStatement->bind_param('sis', $newLote, $newQuantity, $newBirth);

// Process each row of data and insert it into table00
while ($row = $result->fetch_assoc()) {
    $newLote = $row[$oldLote];
    $newQuantity = $row[$oldQuantity];
    $newBirth = $row[$oldBirth];
    $insertStatement->execute();
}

// Close the prepared statement
$insertStatement->close();

// Step 4: Close the database connections
$oldDatabase->close();
$newDatabase->close();

echo 'Data transfer completed!';
?>
