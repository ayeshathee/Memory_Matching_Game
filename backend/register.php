<?php
include "db.php";

if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, email, password) 
            VALUES ('$name', '$email', '$password')";

    if($conn->query($sql) === TRUE){
        header("Location: ../login.html");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>