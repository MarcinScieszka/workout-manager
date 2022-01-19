<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/index.css">
    <link rel="stylesheet" type="text/css" href="public/css/workouts.css">
    <script type="text/javascript" src="/public/js/workouts.js" defer></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workouts</title>
</head>
<body>
    <?php
        include('init.php');
    ?>
    <section>
        <div class="workouts-container">
            <div class="workouts-list">
                <?php foreach ($workouts as $wkt): ?>
                    <div id="workout-item" class="workout-crest">
                        <h3><?=$wkt->getName();?></h3>
                        <div class="workout-inside-box">
                            <h3><?=$wkt->getDifficulty();?></h3>
                            <!--                    <h4>-->
                            <!--                           foreach (... as $exercise) {}-->
                            <!--                       </h4>-->
                        </div>
                        <h3><?=$wkt->getType();?></h3>
                        <a class="workout-details-btn workout-crest" href="/workoutDetails">See details</a>
                    </div>
                <?php endforeach; ?>
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
