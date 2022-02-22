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
        <div class="workout-details content-flex-col">
            <div class="workout-stats">
                <h3>Workout name<span class="accent">:</span> <?= $workout->getName(); ?></h3>
                <h3>Difficulty<span class="accent">:</span> <?= $workout->getDifficulty (); ?></h3>
                <h3>Type<span class="accent">:</span> <?= $workout->getType(); ?></h3>
            </div>
            <div class="exercises">
                <table>
                    <caption>Exercises</caption>
                    <thead>
                        <tr>
                            <th scope="col">Exercise name</th>
                            <th scope="col">Set</th>
                            <th scope="col">Reps</th>
                            <th scope="col">Description</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($workout->getAllExercises() as $exercise): ?>
                        <tr>
                            <th scope="row"><div class="exercise-name"><?= $exercise['name']; ?></div></th>
                            <td><div class="exercise-sets"><?= $exercise['sets']; ?></div></td>
                            <td><div class="exercise-reps"><?= $exercise['reps']; ?></div></td>
                            <td><div class="exercise-description"><?= $exercise['description']; ?></div></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php if(isset($_SESSION['user'])): ?>
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
            <?php endif; ?>
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
