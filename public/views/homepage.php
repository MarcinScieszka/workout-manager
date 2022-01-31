<?php session_start();
    if (isset($_SESSION['user'])) {
        header("Location: http://$_SERVER[HTTP_HOST]/dashboard");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" type="text/css" href="public/css/index.css">
    <link rel="stylesheet" type="text/css" href="public/css/homepage.css">
</head>
<body>
    <?php
        include('init.php');
    ?>
    <section>
        <div class="hero content-flex-col">
            <h1 class="item">Workager, your workout manager</h1>
            <h2 class="item">The best solution to support you <br>
                during your training sessions</h2>
            <div class="btn-container">
                <a href="/register">Sign up now</a>
            </div>
        </div>
    </section>
    <section class="s2">
        <div class="section-2">
            <div class="content-item-1">
                <h1>Dozens of workouts <br> at your fingertips</h1>
                <h2>We offer world-class workouts to help 
                    you become a better version of yourself</h2>
            </div>
            <div class="content-item-2">
                <img src="public/img/single-workout-homepage.png" alt="Single workout">
                <h2>Single workout</h2>
            </div>
            <div class="content-item-3">
                <img src="public/img/workout-plan-homepage.png" alt="Workout plan">
                <h2>Workout plan</h2>
            </div>
        </div>
    </section>
    <section class="s3">
        <div class="section-3">
            <div class="section-3-element grid-col-span-3">
                <h1>Training plan based on your needs</h1>
                <h2>Choose the right type of workout for you</h2>
            </div>
            <div class="section-3-element">
                <img src="public/img/homepage-type-1.jpg" alt="Powerlifting">
                <h2>Powerlifting</h2>
            </div>
            <div class="section-3-element">
                <img src="public/img/homepage-type-2.jpg" alt="Bodybuilding">
                <h2>Bodybuilding</h2>
            </div>
            <div class="section-3-element">
                <img src="public/img/homepage-type-3.jpg" alt="Armwrestling">
                <h2>Armwrestling</h2>
            </div>
        </div>
    </section>
    <section class="s4">
        <div class="section-4">
            <div class="section-4-element">
                <img src="public/img/homepage-difficulty.jpg" alt="">
            </div>
            <div class="section-4-element">
                <h1>Train as hard as you want</h1>
                <h2>Select the difficulty level from the available options:</h2>
                <h3>Just a training</h3>
                <h3>Hard work</h3>
                <h3>Blood, sweat and tears</h3>
                <h3>Death march!</h3>
            </div>
        </div>
    </section>
    <section class="s5">
        <div class="section-5">
            <div class="section-5-element">
                <h1>Facilitated strength progression</h1>
                <h2>Just enter the weights from your
                    first workout session and workager will 
                    automatically suggest a weekly progression</h2>        
            </div>
            <div class="section-5-element">
                <img src="public/img/homepage-graph.png" alt="Graph">
            </div>
        </div>
    </section>
    <?php
        include('elements/footer.php');
    ?>
</body>
</html>
