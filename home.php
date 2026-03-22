<?php
session_start();
include "backend/db.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.html");
    exit();
}

// Fetch user info
$user_id = $_SESSION['user_id'];
$sql = "SELECT total_score, level FROM users WHERE id='$user_id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_score = $row['total_score'];
$level = $row['level'];
?>



<!DOCTYPE html>
<html>
<head>
<title>Memory Game</title>
</head>

<body>

<h1>Memory Game</h1>
<h2>Welcome <?php echo $_SESSION['user_name']; ?></h2>
<p>Total Score: <?php echo $total_score; ?></p>
<p>Level: <?php echo $level; ?></p>
<p>Select a mode</p>

<button onclick="selectMode('normal')">Normal Mode</button>
<br><br>

<button onclick="selectMode('time')">Time Attack</button>
<br><br>

<button onclick="selectMode('moves')">Limited Moves</button>

<script src="js/home.js"></script>
</body>
</html>