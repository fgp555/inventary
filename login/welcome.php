<?php
session_start();
if (!isset($_SESSION['username'])) {
    // User is not logged in, redirect to the login page
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION['username']; ?></h2>
    <p>This is a protected page.</p>
    <a href="logout.php">Logout</a>
</body>
</html>
