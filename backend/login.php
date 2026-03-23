<?php
session_start();
include "db.php";

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);

if($result && $result->num_rows === 1){
    $row = $result->fetch_assoc();
    if(password_verify($password, $row['password'])){
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_name'] = $row['name'];
        echo "success";
    } else {
        echo "wrong_password";
    }
} else {
    echo "no_user";
}
?>