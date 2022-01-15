<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/index.css">
    <link rel="stylesheet" type="text/css" href="public/css/dashboard.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <?php
        include('init.php');
    ?>
    <div class="dashboard-container">
        <section class="dashboard-section-1" >
            <h2>Let's get to work!</h2>
            <div class="workout-plan-container">
                <img src="public/img/workout-plan-homepage.png" alt="Workout plan">
                <a class="workouts-btn" href="/workouts">Choose a workout plan</a>
            </div>
        </section>
    </div>
    <?php
        include('elements/footer.php');
    ?>
</body>
</html>
