document.addEventListener("DOMContentLoaded", function() {

    // Read values from localStorage
    let result = localStorage.getItem("result");
    let correct = Number(localStorage.getItem("correct") || 0);
    let incorrect = Number(localStorage.getItem("incorrect") || 0);
    let moves = Number(localStorage.getItem("moves") || 0);
    let time = Number(localStorage.getItem("time") || 0);
    let grid = Number(localStorage.getItem("grid") || 4);

    // Display values
    document.getElementById("finalCorrect").innerText = correct;
    document.getElementById("finalIncorrect").innerText = incorrect;
    document.getElementById("finalMoves").innerText = moves;
    document.getElementById("finalTime").innerText = time;

    // Score calculation 
    let score = (correct * 10) - incorrect;
    if(score < 0) score = 0;
    document.getElementById("score").innerText = score;

    let stars = "";

    if(result === "lose"){
        stars = "⭐";
    }
    else{
        if(grid === 2){
            if(moves <= 3) stars ='<i class="bi bi-star-fill">  </i>'.repeat (3);
            else if(moves <= 5) stars = '<i class="bi bi-star-fill">  </i>'.repeat ();
            else stars = '<i class="bi bi-star-fill"></i>';
        }
        if(grid === 4){
            if(moves <= 20) stars = '<i class="bi bi-star-fill">  </i>'.repeat (3);
            else if(moves <= 30) stars = '<i class="bi bi-star-fill">  </i>'.repeat (2);
            else stars = '<i class="bi bi-star-fill"></i>';
        }
        if(grid === 6){
            if(moves <= 60) stars = '<i class="bi bi-star-fill">  </i>'.repeat (3);
            else if(moves <= 100) stars = '<i class="bi bi-star-fill">  </i>'.repeat (2);
            else stars = '<i class="bi bi-star-fill"></i>';
        }
    }

    document.getElementById('stars').innerHTML = stars;

});

function restartGame(){
    window.location = "game.html";
}

function goHome(){
    window.location= "home.php";
}