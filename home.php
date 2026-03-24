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

// Progress calculation
$progress = $total_score % 250; // progress in current level
$progress_percent = ($progress / 250) * 100; // convert to %
?>


<!DOCTYPE html>
<html>
<head>
<title>Memory Game</title>
<link rel="stylesheet" href="css/style.css">

</head>

<body>
<br>
<button style="margin-right: 250px;" onclick="window.location='profile.php'">My Profile</button>
<button onclick="logout()">Logout</button>
<br><br>

<h1>Memory Matching Game</h1>
<br>
<h3>Welcome <?php echo $_SESSION['user_name']; ?></h3>

<p>Level: <?php echo $level; ?></p>

<!-- Progress Bar -->
<div class="progress-container">
    <div class="progress-bar" style="width: <?php echo $progress_percent; ?>%;">
        <?php echo $progress; ?>/250
    </div>
</div>
<br><br>
<p>Select a mode</p>

<button onclick="selectMode('normal')">Normal Mode</button>
<br><br>

<button onclick="selectMode('time')">Time Attack</button>
<br><br>

<button onclick="selectMode('moves')">Limited Moves</button>
<br><br>

<script src="js/home.js"></script>
</body>
</html>