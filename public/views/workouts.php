<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workouts</title>
    <link rel="icon" type="image/x-icon" href="/public/img/favicon.ico">
    <link rel="stylesheet" href="/public/css/index.css">
    <link rel="stylesheet" href="/public/css/workouts.css">
    <script type="text/javascript" src="/public/js/workouts.js" defer></script>
    <script type="text/javascript" src="/public/js/searchWorkouts.js" defer></script>
</head>
<body>
    <?php
        include('init.php');
    ?>
    <section class="container">
        <div class="workouts-container content-flex-col">
            <div class="search-bar">
                <label for="workout-search">Search</label>
                <input type="search" id="workout-search" name="workout-search" maxlength="50" minlength="1">
            </div>
            <div class="workouts-list">
                <?php foreach ($workouts as $wkt): ?>
                    <div id="<?=$wkt->getId();?>" class="workout-item workout-crest content-flex-col">
                        <div class="item-name content-flex-col">
                            <h3><?=$wkt->getName();?></h3>
                        </div>
                        <div class="item-difficulty content-flex-col">
                            <h3><?=$wkt->getDifficulty();?></h3>
                        </div>
                        <div class="item-exercises content-flex-col">
                            <?php $exercises = $wkt->getAllExercises();
                            foreach ($exercises as $exercise): ?>
                            <div class="item-exercise">
                                <h3><?=$exercise?></h3>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="item-type content-flex-col">
                            <h3><?=$wkt->getType();?></h3>
                        </div>
                        <div class="item-details content-flex-col">

                            <button class="workout-details-btn workout-crest">
                                <a href="/workout/<?=$wkt->getId();?>">See details</a>
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

<template id="workout-template">
    <div class="workout-item workout-crest content-flex-col">
        <div class="item-name content-flex-col">
            <h3>Name</h3>
        </div>
        <div class="item-difficulty content-flex-col">
            <h3>Difficulty</h3>
        </div>
        <div class="item-exercises content-flex-col">

        </div>
        <div class="item-type content-flex-col">
            <h3>Type</h3>
        </div>
        <div class="item-details content-flex-col">
            <button class="workout-details-btn workout-crest">
                <a>See details</a>
            </button>
        </div>
    </div>
</template>

</html>
