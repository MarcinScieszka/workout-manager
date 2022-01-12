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
        include('header.php');
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

    <?php
        include('footer.php');
    ?>
</body>
</html>