let mode;
let grid;

function selectMode(m){
    localStorage.setItem("mode", m);
    window.location="difficulty.html";
}


function goHome(){
    window.location="home.php";
}

function selectDifficulty(a){
    localStorage.setItem("grid", a);
    window.location="game.html";
}

function logout(){
    window.location = "auth/logout.php";
}
