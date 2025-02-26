<?php
session_start(); // Start session
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare the SQL statement
    $sql = "SELECT user_password FROM tbl_users WHERE user_email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $stored_password);
        
        if (mysqli_stmt_fetch($stmt)) {
            // Verify password
            if ($password === $stored_password) { // Replace with password_verify($password, $stored_password) if using hashed passwords
                $_SESSION['user_email'] = $email; // Store user session
                header("Location: home.php");
                exit();
            } else {
                $_SESSION['error'] = "Invalid email or password.";
                header("Location: login.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "Invalid email or password.";
            header("Location: login.php");
            exit();
        }

        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['error'] = "Database error.";
        header("Location: login.php");
        exit();
    }
}

mysqli_close($conn);
?>