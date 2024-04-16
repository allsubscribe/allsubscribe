<?php
// Database connection configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "note_taking_app";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>