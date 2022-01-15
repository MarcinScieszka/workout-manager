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
    <title>Add workout</title>
</head>
<body>
    <?php
        include('init.php');
    ?>
    <section class="container">
        <div class="workout-form">
            <h1>Add workout</h1>
            <form class="add-workout-form" action="addWorkout" method="POST">
                <div class="messages">
                    <?php
                        if(isset($messages)) {
                            foreach ($messages as $message) {
                                echo $message;
                            }
                        }
                    ?>
                </div>
                <div>
                    <h3>Workout name</h3>
                    <input required name="workout-name" type="text" placeholder="Name...">
                </div>
                <div>
                    <h3>Difficulty</h3>
                    <select class="workout-difficulty" name="workout-difficulty">
                        <option value="Just a training" selected>Just a training (Easy)</option>
                        <option value="Hard work">Hard work (Medium)</option>
                        <option value="Blood, sweat and tears">Blood, sweat and tears (Hard)</option>
                        <option value="Death march">Death march (Very Hard)</option>
                    </select>
                </div>
                <div>
                    <h3>Workout type</h3>
                    <select class="workout-type" name="workout-type">
                        <option value="Armwrestling" selected>Armwrestling</option>
                        <option value="Bodybuilding">Bodybuilding</option>
                        <option value="Powerlifting">Powerlifting</option>
                    </select>
                </div>
                <div>
                    <h3>Exercises</h3>
                    <input name="workout-exercises[]" type="text" placeholder="Exercise name...">

                    <button class="dropdown-button" type="button">
                        <div>
                            <svg style="width: 25px; height: 25px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                                <path d="M8 10.293l4.646-4.647a.5.5 0 0 1 .708.708l-5 5a.5.5 0 0 1-.708 0l-5-5a.5.5 0 1 1 .708-.708L8 10.293z" fill="#757575" fill-rule="evenodd" style="--darkreader-inline-fill: #9e9689;" data-darkreader-inline-fill=""></path>
                            </svg>
                        </div>
                    </button>
                    <input type="checkbox" id="back" name="back">
                    <label for="back">Back</label>
                    <!-- TODO: button "+" that adds another exercise" -->
                </div>
                <div>
                    <input type="submit" value="Add workout">
                </div>

            </form>
        </div>
    </section>
    <?php
        include('elements/footer-logged-in.php');
    ?>
</body>
</html>
