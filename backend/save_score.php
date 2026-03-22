<?php
session_start();
include "db.php";

if(!isset($_SESSION['user_id'])){
    header("Location: ../login.html");
    exit();
}

if(isset($_POST['score'], $_POST['moves'], $_POST['time'], $_POST['difficulty'])){

    $user_id = $_SESSION['user_id'];
    $score = $_POST['score'];
    $moves = $_POST['moves'];
    $time_taken = $_POST['time'];
    $difficulty = $_POST['difficulty'];

    // Save game result
    $sql = "INSERT INTO scores (user_id, score, moves, time_taken, difficulty) 
            VALUES ('$user_id', '$score', '$moves', '$time_taken', '$difficulty')";
    $conn->query($sql);

    // Update total score
    $update_sql = "UPDATE users 
                   SET total_score = total_score + $score,
                       level = CASE
                           WHEN total_score + $score < 101 THEN 1
                           WHEN total_score + $score < 301 THEN 2
                           WHEN total_score + $score < 601 THEN 3
                           ELSE 4
                       END
                   WHERE id = $user_id";

    if($conn->query($update_sql) === TRUE){
        echo "Score & level updated!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>