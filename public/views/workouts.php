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
        <div class="header-item">
            <a href="/"><img src="public/img/logo_text.svg" alt="Workager logo" id="logo"></a>
        </div>
        <div class="header-item header-item-btn">
            <a href="/plans">Plans</a>
        </div>
        <div class="header-item header-item-btn">
            <a href="/workouts">Workouts</a>
        </div>
        <div class="header-item header-item-btn">
            <a href="/contact">Contact</a>
        </div>
        <div class="header-item header-item-btn">
            <a href="/login">Login</a>
        </div>
    </header>
    <div class="workouts-container">
        <div class="workouts-list">
            <div class="workout-item">
                <h3><?=$workout->getName() ?></h3>
                <div class="workout-inside-box">
                    <h2><?=$workout->getDuration() ?></h2>
                    <h3><?=$workout->getDifficulty() ?></h3>
                    <h4>
                        <? foreach ($workout->getExercises() as $exercise) {
                            echo $exercise . '<br>';
                        } ?>
                    </h4>
                </div>
                <h3><?=$workout->getType() ?></h3>
                <a class="abc" href="/workoutDetails">See details</a>
            </div>
            <div class="workout-item">
                <h3>temp-name</h3>
                <div class="workout-inside-box">
                    <h2>temp-duration</h2>
                    <h3>temp-difficulty</h3>
                    <h4>ex1 <br> ex2 <br> ex3 <br> ex4 </h4>
                </div>
                <h3>temp-type</h3>
                <a class="abc" href="/workoutDetails">See details</a>
            </div>
            <div class="workout-item">
                <h3>temp-name</h3>
                <div class="workout-inside-box">
                    <h2>temp-duration</h2>
                    <h3>temp-difficulty</h3>
                    <h4>ex1 <br> ex2 <br> ex3 <br> ex4 </h4>
                </div>
                <h3>temp-type</h3>
                <a class="abc" href="/workoutDetails">See details</a>
            </div>
        </div>
    </div>
    <footer>
        <div class="footer-grid">
            <div class="footer-btn">
                <a href="/register">Register</a>
            </div>
            <div class="footer-btn">
                <a href="/login">Login</a>
            </div>
            <div class="footer-btn">
                <a href="/plans">Plans</a>
            </div>
            <div class="footer-btn">
                <a href="/workouts">Workouts</a>
            </div>
            <div class="footer-btn">
                <a href="/about">About us</a>
            </div>
            <div class="footer-btn">
                <a href="/contact">Contact</a>
            </div>
            <div class="footer-btn">
                <a href="/"><img src="public/img/logo_round.svg" alt="Workager round logo" id="logo-round"></a>
            </div>
        </div>
    </footer>
    <div class="copyright-box">
        <div class="copyright">
            <h5>&copy; Workager 2022</h5>
        </div>
    </div>
</body>
</html>
