<?php
// Database connection details
require "00_conn_db.php";


// Backup file path
$backupPath = __DIR__;

// Check if the backup button is clicked
if (isset($_POST['backup'])) {
    // Backup file name
    $backupFileName = "database_backup_" . date("Y-m-d_H-i-s") . ".sql";

    // Construct the mysqldump command
    $command = "mysqldump --user={$user} --password={$password} --host={$server} {$database} > {$backupPath}/{$backupFileName}";

    // Execute the command
    exec($command, $output, $returnCode);

    // Check if the backup was successful
    if ($returnCode === 0) {
        echo "Database backup created successfully. Backup file: {$backupFileName}";
    } else {
        echo "Error creating database backup. Please check the command and database connection details.";
    }
}

// Check if the restore button is clicked
if (isset($_POST['restore'])) {
    // Check if a file is selected
    if (isset($_FILES['backup_file']) && $_FILES['backup_file']['error'] === UPLOAD_ERR_OK) {
        $backupFile = $_FILES['backup_file']['tmp_name'];

        // Construct the mysql command
        $command = "mysql --user={$user} --password={$password} --host={$server} {$database} < {$backupFile}";

        // Execute the command
        exec($command, $output, $returnCode);

        // Check if the restore was successful
        if ($returnCode === 0) {
            echo "Database restore successful.";
        } else {
            echo "Error restoring database. Please check the command and database connection details.";
        }
    } else {
        echo "No backup file selected for restore.";
    }
}

// Check if the delete button is clicked for a backup file
if (isset($_POST['delete'])) {
    $backupFile = $_POST['backup_file'];

    // Delete the backup file
    if (file_exists($backupFile)) {
        unlink($backupFile);
        echo "Backup file deleted successfully.";
    } else {
        echo "Backup file does not exist.";
    }
}

// Get a list of backup files
$backupFiles = glob($backupPath . "/database_backup_*.sql");

// Get the domain URL
$domainUrl = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];

?>

<!DOCTYPE html>
<html>
<head>
    <title>Create and Restore Database Backup</title>
</head>
<body>
    <h2>Create and Restore Database Backup</h2>

    <h3>Create Backup</h3>
    <form method="post" action="">
        <input type="submit" name="backup" value="Create Backup">
    </form>

    <h3>Restore Backup</h3>
    <form method="post" action="" enctype="multipart/form-data">
        <input type="file" name="backup_file">
        <input type="submit" name="restore" value="Restore Backup">
    </form>

    <h3>Available Backups</h3>
    <style>
        .backupFiles li {
            display: flex;
            gap: 1em;
        }
        a {
            color: brown;
        }
    </style>
    <?php if (!empty($backupFiles)): ?>
        <ul class="backupFiles">
            <?php foreach ($backupFiles as $file): ?>
                <li>
                    <a href="<?php echo $domainUrl . '/' . basename($file); ?>" download><?php echo basename($file); ?></a>
                    <form method="post" action="">
                        <input type="hidden" name="backup_file" value="<?php echo $file; ?>">
                        <input type="submit" name="delete" value="Delete">
                    </form>
                </li>
                <br>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No backup files found.</p>
    <?php endif; ?>
</body>
</html>
