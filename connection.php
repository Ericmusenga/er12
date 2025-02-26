<?php

// Create connection
$conn = mysqli_connect("localhost","root","","eric_devops_db");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>