<?php
session_start();
include "../includes/db.php"; 

if($_SERVER['REQUEST_METHOD'] === 'POST'){
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

    // insert new user
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql_insert = "INSERT INTO users (name, email, password) 
                   VALUES ('$name', '$email', '$hashed_password')";

    if($conn->query($sql_insert)){
        echo "success";
    } else {
        echo "error";
    }

    exit(); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>

    <link rel="stylesheet" href="../css/login.css">
</head>
<body>

<div class="container">
    <h2>Create Account</h2>

    <form id="registerForm">
        <input type="text" id="name" required placeholder="Name">
        <input type="email" id="email" required placeholder="Email">
        <input type="password" id="password" required placeholder="Password">
        <button type="submit">Register</button>
    </form>

    <a href="login.php">Already have an account? Login</a>
</div>

<script>
document.getElementById("registerForm").addEventListener("submit", function(e){
    e.preventDefault();

    let name = document.getElementById("name").value;
    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;

    fetch('register.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: `name=${encodeURIComponent(name)}&email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}`
    })
    .then(res => res.text())
    .then(data => {
        data = data.trim();

        if(data === "success"){
            alert("Registration successful!");
            window.location = "login.php";
        } else if(data === "email_exists"){
            alert("Email already used!");
        } else {
            alert("Registration failed. Try again!");
        }
    })
    .catch(err => console.error("Error:", err));
});
</script>

</body>
</html>