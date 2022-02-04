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
    <link rel="stylesheet" type="text/css" href="/public/css/index.css">
    <link rel="stylesheet" type="text/css" href="/public/css/workouts.css">
    <link rel="stylesheet" type="text/css" href="/public/css/myWorkouts.css">
    <script type="text/javascript" src="/public/js/workouts.js" defer></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
</head>
<body>
<?php include('init.php'); ?>

<section class="container">
    <div class="workouts-container">
        <?php if ($userWorkouts == null): ?>
            <div class="no-workouts content-flex-col">
                <h1>No workouts to see...</h1>
                <div class="go-back-btn">
                    <a href="/">Go back</a>
                </div>
                <h2>or</h2>
                <div class="action-btn">
                    <a href="/addWorkout">Create workout</a>
                </div>
            </div>
        <?php endif; ?>
        <div class="my-workouts-content content-flex-col">
            <div>
                <h1>Your workouts:</h1>
            </div>
            <div class="workouts-list">
                <?php foreach ($userWorkouts as $wkt): ?>
                    <div class="workout-item workout-crest content-flex-col">
                        <div class="item-name content-flex-col">
                            <h3><?=$wkt->getName();?></h3>
                        </div>
                        <div class="item-difficulty content-flex-col">
                            <h3><?=$wkt->getDifficulty();?></h3>
                        </div>
                        <div class="item-exercises content-flex-col">
                            <?php $exercises = $wkt->getAllExercises();
                            foreach ($exercises as $exercise) {
                                echo "<pre>"; print_r($exercise); echo "</pre>";
                            } ?>
                        </div>
                        <div class="item-type content-flex-col">
                            <h3><?=$wkt->getType();?></h3>
                        </div>
                        <div class="item-details content-flex-col">
                            <button class="workout-details-btn workout-crest">
                                <a href="/workout?id=<?=$wkt->getId();?>">See details</a>
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</section>
<?php
include('elements/footer-logged-in.php');
?>
</body>
</html>
