<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['assign_workout_id'] = $workout->getId();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workout details</title>
    <link rel="icon" type="image/x-icon" href="/public/img/favicon.ico">
    <link rel="stylesheet" href="/public/css/index.css">
    <link rel="stylesheet" href="/public/css/workout.css">
    <script type="text/javascript" src="/public/js/index.js" defer></script>
    <script type="text/javascript" src="/public/js/header.js" defer></script>
</head>
<body>
<?php
require_once('init.php');
?>
<section class="container">
    <div class="content-flex-col">
        <div class="workout-details">
            <div class="workout-stats">
                <h3>Workout name<span class="accent">:</span> <?= $workout->getName(); ?></h3>
                <h3>Difficulty<span class="accent">:</span> <?= $workout->getDifficulty (); ?></h3>
                <h3>Type<span class="accent">:</span> <?= $workout->getType(); ?></h3>
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
            <div class="assign-workout-form">
                <form class="content-flex-col" action="assignWorkout" method="POST">
                    <div>
                        <label for="workout-date">Choose workout date<span class="accent">:</span></label>
                        <input id="workout-date" class="workout-date" type="datetime-local" name="workout-date" min="<?= $min_datetime; ?>" max="<?= $max_datetime; ?>" required>
                    </div>
                    <div class="choose-workout-btn">
                        <input  type="submit" value="Choose">
                    </div>
                </form>
            </div>
        </div>
        <div class="go-back-btn">
            <a href="/workouts">Go back</a>
        </div>
    </div>
</section>
<?php
if (isset($_SESSION['user'])) {
    include('elements/footer-logged-in.php');
}
else {
    include('elements/footer.php');
}
?>
</body>
</html>
