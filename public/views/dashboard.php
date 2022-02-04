<?php
    session_start();
    if (!isset($_SESSION['user'])) {
        header("Location: http://$_SERVER[HTTP_HOST]/login");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/index.css">
    <link rel="stylesheet" type="text/css" href="public/css/dashboard.css">
    <link rel="stylesheet" type="text/css" href="public/css/workout.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <?php
        include('init.php');
    ?>
    <div class="dashboard-container content-flex-col">
        <div class="content-flex-row dashboard-navigation">
            <a class="btn-navigate " href="/myWorkouts">My workouts</a>
            <a class="btn-navigate" href="/addWorkout">Create a workout</a>
        </div>
        <?php if($userHasAssignedWorkout): ?>
            <div class="active-workout-container content-flex-col">
                <h2 class="active-workout-text">Active workout:</h2>
                <div class="workout-details">
                    <div class="workout-stats">
                        <h3>Workout name<span class="accent">:</span> <?= $workout->getName(); ?></h3>
                        <h3>Difficulty<span class="accent">:</span> <?= $workout->getDifficulty (); ?></h3>
                        <h3>Type<span class="accent">:</span> <?= $workout->getType(); ?></h3>
                        <h3>Workout date<span class="accent">:</span> <?= $workoutDate; ?></h3>
                    </div>
                    <div class="exercises">
                        <h3>Exercises<span class="accent">:</span> </h3>
                        <?php foreach ($workout->getAllExercises() as $exercise): ?>
                            <div class="exercise-item">
                                <div class="exercise-name"><?= $exercise['name']; ?></div>
                                <div class="exercise-sets">Sets<span class="accent">:</span> <?= $exercise['sets']; ?></div>
                                <div class="exercise-reps">Reps<span class="accent">:</span> <?= $exercise['reps']; ?></div>
                                <div class="exercise-description">Description<span class="accent">:</span> <?= $exercise['description']; ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <form method="POST" action="completeWorkout">
                        <?php $_SESSION['assigned_workout_id'] = $workout->getId(); ?>
                        <button name="completeWorkout" class="action-btn" type="submit">Mark as completed</button>
                        <button name="cancelWorkout" class="secondary-btn" type="submit">Cancel</button>
                    </form>
                </div>
            </div>
        <?php else: ?>
            <h2>Let's get to work!</h2>
            <div class="dashboard-grid">
                <div class="dashboard-item content-flex-col">
                    <img src="public/img/workout-plan-homepage.png" alt="Workout plan">
                    <a class="workouts-btn" href="/workouts">Choose a workout plan</a>
                </div>
                <div class="dashboard-item content-flex-col">
                    <img src="public/img/single-workout-homepage.png" alt="Workout plan">
                    <a class="workouts-btn" href="/workouts">Choose a single workout</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <?php
        include('elements/footer-logged-in.php');
    ?>
</body>
</html>
