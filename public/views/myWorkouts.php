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
    <link rel="stylesheet" type="text/css" href="public/css/workouts.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
</head>
<body>
<?php include('init.php'); ?>

<section class="container">
    <div class="workouts-container">
        <div class="workouts-list">
            <?php foreach($userWorkouts as $wkt): ?>
                <div id="workout-item" class="workout-crest">
                    <h3><?=$wkt->getName();?></h3>
                    <div class="workout-inside-box">
                        <h3><?=$wkt->getDifficulty();?></h3>
                        <?
                        $exercises = $wkt->getAllExercises();
                        foreach($exercises as $exercise) {
                            echo "<pre>"; print_r($exercise); echo "</pre>";
                        }
                        ?>
                    </div>
                    <h3><?=$wkt->getType();?></h3>
                    <a class="workout-details-btn workout-crest" href="/workoutDetails">See details</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php
include('elements/footer-logged-in.php');
?>
</body>
</html>
