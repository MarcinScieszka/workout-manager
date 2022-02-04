function colorizeWorkoutItems() {
    let workoutDifficultyLabel = document.getElementsByClassName("item-difficulty");
    console.log(workoutDifficultyLabel.length);
    for(let i = 0; i < workoutDifficultyLabel.length; i++){
        switch (workoutDifficultyLabel[i].innerText) {
            case "Just a training":
                workoutDifficultyLabel[i].classList.add("workout-crest-easy");
                break;
            case "Hard work":
                workoutDifficultyLabel[i].classList.add("workout-crest-medium");
                break;
            case "Blood, sweat and tears":
                workoutDifficultyLabel[i].classList.add("workout-crest-hard");
                break;
            case "Death march":
                workoutDifficultyLabel[i].classList.add("workout-crest-very-hard");
                break;
            default:
                console.log(workoutDifficultyLabel[i].innerText);
                break;
        }
    }
}

window.onload = colorizeWorkoutItems;