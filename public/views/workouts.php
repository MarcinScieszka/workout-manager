<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/index.css">
    <link rel="stylesheet" type="text/css" href="public/css/workouts.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workouts</title>
</head>
<body>
<header>
    <?php
        include('header.php');
    ?>

    <div class="workouts-container">
        <div class="workouts-list">
            <!--                TODO: display all workouts form the database-->

            <div class="workout-item">
<!--                <h3>--><?//=$workout->getName() ?><!--</h3>-->
                <div class="workout-inside-box">
<!--                    <h3>--><?//=$workout->getDifficulty() ?><!--</h3>-->
<!--                    <h4>-->
<!--                        --><?// foreach ($workout->getExercises() as $exercise) {
//                            echo $exercise . '<br>';
//                        } ?>
<!--                    </h4>-->
                </div>
<!--                <h3>--><?//=$workout->getType() ?><!--</h3>-->
                <a class="abc" href="/workoutDetails">See details</a>
            </div>
        </div>
    </div>

    <?php
        include('footer.php');
    ?>
</body>
</html>
