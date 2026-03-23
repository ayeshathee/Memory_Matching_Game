let mode;
let grid;

function selectMode(m){
    localStorage.setItem("mode", m);
    window.location="difficulty.html";
}

mode = localStorage.getItem("mode");
console.log(mode,typeof(mode));

function goHome(){
    window.location="home.php";
}

function selectDifficulty(a){
    localStorage.setItem("grid", a);
    window.location="game.html";
}

function logout(){
    console.log("Logout clicked");
    window.location = "backend/logout.php";
}

grid = localStorage.getItem("grid");
console.log(grid,typeof(grid));

console.log("home.js loaded");