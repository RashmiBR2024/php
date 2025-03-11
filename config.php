<?php
$host = "localhost"; // Change if using a remote server
$user = "root"; // Your MySQL username
$password = "SandHut@123*"; // Your MySQL password (keep empty if not set)
$database = "staynest"; // Your database name

$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Uncomment this line to confirm successful connection
// echo "Database connected successfully";
?>
