<?php
$host = "localhost";
$user = "root";
$password = "2004";
$database = "memory_game";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>