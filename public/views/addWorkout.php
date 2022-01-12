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
                <select class="workout-difficulty" name = "workout-difficulty">
                    <option value = "Easy" selected>Easy</option>
                    <option value = "Medium">Medium</option>
                    <option value = "Hard">Hard</option>
                    <option value = "Hard">Very Hard</option>
                </select>
                <h3>Workout type</h3>
                <input name="workout-type" type="text" placeholder="Type of workout...">
                <h3>Exercises</h3>
                <input name="workout-exercises[]" type="text" placeholder="Exercise name...">
                <input name="workout-exercises[]" type="text" placeholder="Exercise name...">
                <input name="workout-exercises[]" type="text" placeholder="Exercise name...">
                <!-- TODO: button "+" that adds another exercise" -->
                <input type="submit" value="Add workout">
            </form>
        </div>
    </section>

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