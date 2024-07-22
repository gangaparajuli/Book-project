<?php
$servername = "db";
$username = "user";
$password = "user_password";
$dbname = "book_companion";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
