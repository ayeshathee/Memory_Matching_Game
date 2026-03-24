<?php
session_start();
include "db.php"; 

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// check if email already exists
$sql_check = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql_check);

if($result && $result->num_rows > 0){
    echo "email_exists";
    exit();
}

// email not exists insert new user
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql_insert = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashed_password')";

if($conn->query($sql_insert)){
    echo "success";
} else {
    echo "error";
}
?>
