function colorizeWorkoutItems() {
    let workoutItems = document.getElementsByClassName("workout-item");
    let x = document.getElementsByClassName("item-difficulty");
    console.log(x.length);
    for(let i = 0; i < x.length; i++){
        switch (x[i].innerText) {
            case "Just a training":
                workoutItems[i].classList.add("workout-crest-easy");
                break;
            case "Hard work":
                workoutItems[i].classList.add("workout-crest-medium");
                break;
            case "Blood, sweat and tears":
                workoutItems[i].classList.add("workout-crest-hard");
                break;
            case "Death march":
                workoutItems[i].classList.add("workout-crest-very-hard");
                break;
            default:
                console.log(x[i].innerText);
                break;
        }
    }
}

window.onload = colorizeWorkoutItems;
