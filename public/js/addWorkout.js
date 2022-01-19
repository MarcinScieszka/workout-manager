function showExerciseType(chosenExerciseType) {
    // let exerciseType =  document.getElementsByClassName(chosenExerciseType);
    let exerciseType =  document.querySelector('.' + chosenExerciseType);
    if (exerciseType.style.display === "none") {
        exerciseType.style.display = "block";
    }
    else {
        exerciseType.style.display = "none";
    }
}
