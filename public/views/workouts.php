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
