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
$progress = $total_score % 250;
$progress_percent = ($progress / 250) * 100;
?>


<!DOCTYPE html>
<html>
<head>
<title>Memory Game</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/home.css">
</head>

<body>
<br>
<h1>Memory Matching Game</h1>
<br>
<button style="margin-right: 750px;" onclick="window.location='profile.php'">My Profile</button>
<button onclick="logout()">Logout</button>
<h2>Welcome <?php echo $_SESSION['user_name']; ?></h2>

<p>Level: <?php echo $level; ?></p>

<!-- Progress Bar -->
<div class="progress-container">
    <div class="progress-bar" style="width: <?php echo $progress_percent; ?>%;">
        <?php echo $progress; ?>/250
    </div>
</div>
<br><br>
<h3>Select a game mode to begin your challenge.</h3>

<div class="mode-container">

    <div class="mode-card">
        <div class="icon"><i class="bi bi-play-fill"></i></div>
        <h3>Normal Mode</h3>
        <p>Play at your own pace</p><br>
        <button onclick="selectMode('normal')">Select</button>
    </div>

    <div class="mode-card">
        <div class="icon"><i class="bi bi-stopwatch"></i></div>
        <h3>Time Attack</h3>
        <p>Beat the clock before time runs out</p>
        <button onclick="selectMode('time')">Select</button>
    </div>

    <div class="mode-card">
        <div class="icon"><i class="bi bi-person-walking"></i></div>
        <h3>Limited Moves</h3>
        <p>Complete the game with limited moves</p>
        <button onclick="selectMode('moves')">Select</button>
    </div>

</div>
<script src="js/home.js"></script>
</body>
</html>