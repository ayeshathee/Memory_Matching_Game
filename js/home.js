let mode;
let grid;

function selectMode(m){
    localStorage.setItem("mode", m);
    window.location="difficulty.html";
}

mode = localStorage.getItem("mode");
console.log(mode,typeof(mode));

function goHome(){
    window.location="home.html";
}

function selectDifficulty(a){
    localStorage.setItem("grid", a);
    window.location="game.html";
}

grid = localStorage.getItem("grid");
console.log(grid,typeof(grid));