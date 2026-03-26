<?php
session_start();
include "../includes/db.php";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
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

    exit(); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <link rel="stylesheet" href="../css/login.css">
</head>
<body>

<div class="container">
    <h2>Login</h2>

    <form id="loginForm">
        <input type="email" id="email" required placeholder="Email">
        <input type="password" id="password" required placeholder="Password">
        <button type="submit">Login</button>
    </form>

    <a href="register.php">Don't have an account? Create Account</a>
</div>

<script>
document.getElementById("loginForm").addEventListener("submit", function(e){
    e.preventDefault();

    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;

    fetch('login.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: `email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}`
    })
    .then(res => res.text())
    .then(data => {
        data = data.trim();

        if(data === "success"){
            window.location = "../home.php";
        } else if(data === "wrong_password"){
            alert("Wrong password!");
        } else if(data === "no_user"){
            alert("User not found!");
        } else {
            alert("Login failed!");
        }
    })
    .catch(err => console.error("Error:", err));
});
</script>

</body>
</html>