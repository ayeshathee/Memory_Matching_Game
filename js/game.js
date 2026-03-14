let grid = Number(localStorage.getItem("grid"));
let mode = localStorage.getItem("mode");

let board = document.getElementById("board");

board.style.display = "grid";
board.style.gridTemplateColumns = `repeat(${grid},1fr)`;
board.style.gap = "10px";

// icon list
let icons = [
"bi-heart","bi-star","bi-camera","bi-bell","bi-alarm",
"bi-airplane","bi-apple","bi-cloud","bi-lightning",
"bi-moon","bi-sun","bi-gift","bi-emoji-smile",
"bi-controller","bi-globe","bi-music-note",
"bi-car-front","bi-tree"
];

// number of pairs
let pairs = (grid * grid) / 2;

// select needed icons
let symbols = icons.slice(0, pairs);

// duplicate for pairs
symbols = [...symbols, ...symbols];

// shuffle
symbols.sort(() => Math.random() - 0.5);


// game variables
let firstCard = null;
let secondCard = null;
let lock = false;

let correct = 0;
let incorrect = 0;
let moves = 0;

let timeLimit = 0;
let moveLimit = 0;


// mode rules
if(mode === "time"){

    if(grid === 2) timeLimit = 10;
    if(grid === 4) timeLimit = 120;
    if(grid === 6) timeLimit = 300;

}

if(mode === "moves"){

    if(grid === 2) moveLimit = 5;
    if(grid === 4) moveLimit = 30;
    if(grid === 6) moveLimit = 100;

}


let time = 0; // tracks elapsed time
let timer = setInterval(() => {

    if (mode === "time") {
        // countdown mode
        let remaining = timeLimit - time;
        document.getElementById("time").innerText = remaining;

        time++; // increment elapsed time for storing in result

        if (remaining <= 0) {
            clearInterval(timer);
            endGame("lose"); // time over
        }

    } else {
        // normal or moves mode → count up
        time++;
        document.getElementById("time").innerText = time;
    }

}, 1000);



// create cards
symbols.forEach(symbol=>{

    let card = document.createElement("div");
    card.classList.add("card");

    card.dataset.symbol = symbol;

    card.addEventListener("click",()=>{

        if(lock || card.innerHTML !== "") return;

        card.innerHTML = `<i class="bi ${symbol}"></i>`;

        if(!firstCard){
            firstCard = card;
        }
        else{

            secondCard = card;
            checkMatch();

        }

    });

    board.appendChild(card);

});



function checkMatch(){

    moves++;

if(mode === "moves"){
    let remainingMoves = moveLimit - moves;
    if(remainingMoves < 0) remainingMoves = 0;
    document.getElementById("moves").innerText = remainingMoves;
} else {
    document.getElementById("moves").innerText = moves;
}

// check move limit
if(mode === "moves" && moves > moveLimit){
    endGame("lose");
}
    if(mode === "moves" && moves > moveLimit){

        endGame("lose");

    }

    if(firstCard.dataset.symbol === secondCard.dataset.symbol){

        correct++;
        document.getElementById("correct").innerText = correct;

        firstCard = null;
        secondCard = null;

        // win condition
        if(correct === pairs){

            endGame("win");

        }

    }
    else{

        incorrect++;
        document.getElementById("incorrect").innerText = incorrect;

        lock = true;

        setTimeout(()=>{

            firstCard.innerHTML = "";
            secondCard.innerHTML = "";

            firstCard = null;
            secondCard = null;

            lock = false;

        },1000);

    }

}

function endGame(result){

    localStorage.setItem("result", result);
    localStorage.setItem("correct", correct);
    localStorage.setItem("incorrect", incorrect);
    localStorage.setItem("moves", moves);
    localStorage.setItem("time", time);
    localStorage.setItem("grid", grid); 

    window.location = "result.html";
}



function goHome(){

    window.location = "home.html";

}