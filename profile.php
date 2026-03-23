<?php
session_start();
include "backend/db.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user_id'];

// Get user data
$user_sql = "SELECT name, total_score, level FROM users WHERE id='$user_id'";
$user_result = $conn->query($user_sql);
$user = $user_result->fetch_assoc();

$total_score = $user['total_score'];
$level = $user['level'];
$name = $user['name'];

// Progress calculation
$progress = $total_score % 250;
$progress_percent = ($progress / 250) * 100;

// Get game history
$history_sql = "SELECT score, moves, time_taken, difficulty, created_at 
                FROM scores 
                WHERE user_id='$user_id' 
                ORDER BY created_at DESC";
$history_result = $conn->query($history_sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>My Profile</title>

<style>
body {
    font-family: Arial;
    background: #f4f4f4;
    text-align: center;
}

.container {
    width: 80%;
    margin: auto;
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px gray;
}

/* Progress Bar */
.progress-container {
    width: 300px;
    background: #ddd;
    border-radius: 20px;
    margin: 10px auto;
    overflow: hidden;
}

.progress-bar {
    height: 20px;
    background: linear-gradient(to right, #00c853, #64dd17);
    color: white;
    font-size: 12px;
    line-height: 20px;
}

/* Table */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table, th, td {
    border: 1px solid #ccc;
}

th {
    background: #007BFF;
    color: white;
}

td, th {
    padding: 10px;
}

/* Buttons */
button {
    padding: 10px 15px;
    margin-top: 15px;
    border: none;
    background: #007BFF;
    color: white;
    cursor: pointer;
}

button:hover {
    background: #0056b3;
}
</style>

</head>

<body>

<div class="container">

    <h1>My Profile</h1>

    <h2><?php echo $name; ?></h2>

    <p><b>Total Score:</b> <?php echo $total_score; ?></p>
    <p><b>Level:</b> <?php echo $level; ?></p>

    <!-- Progress Bar -->
    <div class="progress-container">
        <div class="progress-bar" style="width: <?php echo $progress_percent; ?>%;">
            <?php echo $progress; ?>/250
        </div>
    </div>

    <p><?php echo 250 - $progress; ?> points to next level</p>

    <!-- Game History -->
    <h3>Game History</h3>

    <table>
        <tr>
            <th>Score</th>
            <th>Moves</th>
            <th>Time</th>
            <th>Mode</th>
            <th>Date</th>
        </tr>

        <?php
        if($history_result->num_rows > 0){
            while($row = $history_result->fetch_assoc()){
                echo "<tr>
                        <td>{$row['score']}</td>
                        <td>{$row['moves']}</td>
                        <td>{$row['time_taken']}</td>
                        <td>{$row['difficulty']}</td>
                        <td>{$row['created_at']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No games played yet</td></tr>";
        }
        ?>
    </table>

    <!-- Back Button -->
    <button onclick="window.location='home.php'">Back to Home</button>

</div>

</body>
</html>