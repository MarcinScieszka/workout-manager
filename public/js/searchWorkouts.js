const workoutSearch = document.getElementById("workout-search");
const workoutContainer = document.querySelector(".workouts-list");

workoutSearch.addEventListener("keyup", function (event) {
    if (event.key === "Enter") {
        event.preventDefault();

        const searchData = {search: this.value};

        fetch("/search", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(searchData)
        }).then(function (response) {
            return response.json();
        }).then(function (workouts) {
            workoutContainer.innerHTML = "";
            loadWorkouts(workouts);
            colorizeWorkoutItems();
        });
    }
});

function loadWorkouts(workouts) {
    workouts.forEach(workout => {
        createWorkout(workout);
    });
}

function createWorkout(workout) {
    const workoutTemplate = document.getElementById("workout-template");
    const clone = workoutTemplate.content.cloneNode(true);

    const name = clone.querySelector(".item-name");
    name.innerText = workout.workout_name;

    const difficulty = clone.querySelector(".item-difficulty");
    difficulty.innerText = workout.difficulty;

    const type = clone.querySelector(".item-type");
    type.innerText = workout.type;

    const exercises = clone.querySelector(".item-exercises");
    workout.exercises.forEach(exe => {
        const exercise = document.createElement('div');
        const exerciseName = document.createElement("h3");
        exercise.classList.add('item-exercise');
        exerciseName.innerHTML = exe;
        exercise.appendChild(exerciseName);
        exercises.appendChild(exercise);
    });

    const detailsLink = clone.querySelector("a");
    detailsLink.href = `/workout/${workout.id}`;
    workoutContainer.appendChild(clone);
}
