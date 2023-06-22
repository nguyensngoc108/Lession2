<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "categories";

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to get the database connection
function getDBConnection() {
    global $conn;
    return $conn;
}
?>
