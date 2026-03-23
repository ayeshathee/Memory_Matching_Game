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

<style>
.progress-container {
    
    width: 300px;
    background: #ddd;
    border-radius: 20px;
    overflow: hidden;
    margin: 10px auto;
}

.progress-bar {
    height: 20px;
    background: linear-gradient(to right, #00c853, #64dd17);
    text-align: center;
    color: white;
    font-size: 12px;
    line-height: 20px;
    transition: width 0.5s;
}
</style>

</head>

<body>
<button onclick="logout()">Logout</button>

<h1>Memory Game</h1>

<h2>Welcome <?php echo $_SESSION['user_name']; ?></h2>

<p>Total Score: <?php echo $total_score; ?></p>

<p>Level: <?php echo $level; ?></p>

<!-- Progress Bar -->
<div class="progress-container">
    <div class="progress-bar" style="width: <?php echo $progress_percent; ?>%;">
        <?php echo $progress; ?>/250
    </div>
</div>

<p>Select a mode</p>

<button onclick="selectMode('normal')">Normal Mode</button>
<br><br>

<button onclick="selectMode('time')">Time Attack</button>
<br><br>

<button onclick="selectMode('moves')">Limited Moves</button>

<script src="js/home.js"></script>
</body>
</html>