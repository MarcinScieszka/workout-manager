<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/index.css">
    <link rel="stylesheet" type="text/css" href="public/css/workouts.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add workout</title>
</head>
<body>
    <?php
        include('init.php');
    ?>
    <section class="container">
        <div class="workout-form">
            <h1>Add workout</h1>
            <form action="addWorkout" method="POST">
                <div class="messages">
                    <?php
                        if(isset($messages)) {
                            foreach ($messages as $message) {
                                echo $message;
                            }
                        }
                    ?>
                </div>
                <h3>Workout name</h3>
                <input name="workout-name" type="text" placeholder="Name...">
                <h3>Difficulty</h3>
                <select class="workout-difficulty" name="workout-difficulty">
                    <option value="Just a training" selected>Just a training (Easy)</option>
                    <option value="Hard work">Hard work (Medium)</option>
                    <option value="Blood, sweat and tears">Blood, sweat and tears (Hard)</option>
                    <option value="Death march">Death march (Very Hard)</option>
                </select>
                <h3>Workout type</h3>
                <select class="workout-type" name="workout-type">
                    <option value="Armwrestling" selected>Armwrestling</option>
                    <option value="Bodybuilding">Bodybuilding</option>
                    <option value="Powerlifting">Powerlifting</option>
                </select>
<!--                <input name="workout-type" type="text" placeholder="Type of workout...">-->
                <h3>Exercises</h3>
                <input name="workout-exercises[]" type="text" placeholder="Exercise name...">
                <input name="workout-exercises[]" type="text" placeholder="Exercise name...">
                <input name="workout-exercises[]" type="text" placeholder="Exercise name...">
                <!-- TODO: button "+" that adds another exercise" -->
                <input type="submit" value="Add workout">
            </form>
        </div>
    </section>
    <?php
        include('elements/footer.php');
    ?>
</body>
</html>
