<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate the credentials (replace with your own validation logic)
    if ($username === 'asdf' && $password === 'asdf') {
        // Successful login, store username in session and redirect to a protected page
        $_SESSION['username'] = $username;
        header('Location: welcome.php');
        exit();
    } else {
        // Invalid credentials, display an error message
        echo "Invalid username or password";
    }
}
?>
