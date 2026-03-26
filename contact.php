<?php
session_start();
include "includes/db.php";

$success = "";
$error = "";

if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    if($name == "" || $email == "" || $message == ""){
        echo "<script>alert('All fields are required!');</script>";
    } else {

        $sql = "INSERT INTO messages (name, email, message) 
                VALUES ('$name', '$email', '$message')";

        if($conn->query($sql) === TRUE){
            echo "<script>
                    alert('Message sent successfully!');
                    window.location='contact.php';
                  </script>";
        } else {
            echo "<script>alert('Error sending message!');</script>";
        }
    }
}
?>


<!DOCTYPE html>
<html>
<head>
<title>Contact Us</title>
<style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
    margin: 0;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.container {
    width: 450px; 
    padding: 40px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    backdrop-filter: blur(10px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.6); 
    text-align: center;
    color: white;
}


h1 {
    margin-bottom: 20px; 
    font-size: 35px;
    font-weight: 600;
}


input, textarea {
    width: 95%; 
    padding: 15px; 
    margin: 15px 0; 
    border-radius: 10px;
    border: none;
    outline: none;
    font-size: 18px;
    background-color: rgb(255, 255, 255); 
    color: black;
}


textarea {
    resize: none;
}


button {
    width: 98%; 
    padding: 18px; 
    margin-top: 20px; 
    border: none;
    border-radius: 10px; 
    background: linear-gradient(to right, #00c6ff, #0072ff);
    color: white;
    font-size: 18px; 
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    transform: scale(1.1); 
    background: linear-gradient(to right, #0072ff, #00c6ff);
}


.back-btn {
    width: 98%; 
    background: linear-gradient(to right, #ff4b2b, #ff416c);
    padding: 18px; 
}

.back-btn:hover {
    background: linear-gradient(to right, #ff416c, #ff4b2b);
}

.container > p {
    font-size: 20px;
    margin-bottom: 25px;
}
</style>


</head>

<body>

<div class="container">

    <h1>Contact Us</h1>

  
    <?php if($success != "") echo "<p style='color:lightgreen;'>$success</p>"; ?>
    <?php if($error != "") echo "<p style='color:red;'>$error</p>"; ?>

    <!-- Form -->
    <form method="POST">

        <input type="text" name="name" placeholder="Your Name">
        <br>

        <input type="email" name="email" placeholder="Your Email">
        <br>

        <textarea name="message" placeholder="Your Message" rows="5"></textarea>
        <br>

        <button type="submit" name="submit">Send Message</button>

    </form>

    <br>

    <button class="back-btn" onclick="window.location='home.php'">Back to Home</button>

</div>

</body>
</html>