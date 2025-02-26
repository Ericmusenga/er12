<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare the SQL statement
    $sql = "SELECT user_password FROM tbl_users WHERE user_email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        // Bind the email parameter
        mysqli_stmt_bind_param($stmt, "s", $email);

        // Execute the statement
        mysqli_stmt_execute($stmt);

        // Bind the result variable
        mysqli_stmt_bind_result($stmt, $stored_password);

        // Fetch the result
        if (mysqli_stmt_fetch($stmt)) {
            // Compare the stored password with the entered password
            if ($password === $stored_password) {
                // Passwords match; redirect to home.php
                header("Location: home.php");
                exit();
            } else {
                // Passwords don't match
                echo "Invalid credentials.";
            }
        } else {
            // No user found with the entered email
            echo "Invalid credentials.";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing statement: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>