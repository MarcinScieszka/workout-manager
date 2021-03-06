<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['user'])) {
        header("Location: http://$_SERVER[HTTP_HOST]/login");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add workout</title>
    <link rel="icon" type="image/x-icon" href="/public/img/favicon.ico">
    <link rel="stylesheet" href="/public/css/index.css">
    <link rel="stylesheet" href="/public/css/addWorkout.css">
    <script type="text/javascript" src="/public/js/index.js" defer></script>
    <script type="text/javascript" src="/public/js/header.js" defer></script>
    <script type="text/javascript" src="/public/js/index.js" defer></script>
</head>
<body>
    <?php
        include('init.php');
    ?>
    <section class="container">
        <div class="workout-form content-flex-col">
            <h1>Add workout</h1>
            <form class="add-workout-form content-flex-col" action="addWorkout" method="POST">
                <h3><label for="workout-name">Workout name</label></h3>
                <input required name="workout-name" type="text" id="workout-name" placeholder="Name...">

                <h3><label for="workout-difficulty">Difficulty</label></h3>
                <select class="workout-difficulty" name="workout-difficulty" id="workout-name" >
                    <option value="Just a training" selected>Just a training (Easy)</option>
                    <option value="Hard work">Hard work (Medium)</option>
                    <option value="Blood, sweat and tears">Blood, sweat and tears (Hard)</option>
                    <option value="Death march">Death march (Very Hard)</option>
                </select>

                <h3><label for="workout-type">Workout type</label></h3>
                <select class="workout-type" name="workout-type" id="workout-type">
                    <option value="Armwrestling" selected>Armwrestling</option>
                    <option value="Bodybuilding">Bodybuilding</option>
                    <option value="Powerlifting">Powerlifting</option>
                </select>

                <h3>Exercises</h3>
                <div class="exercise-types-grid">
                    <?php foreach ($exercises as $key=>$exerciseType): ?>
                    <div class="exercise-type-box-content">
                        <div class="exercise-type-box">
                            <h3><?= ucfirst($key); ?></h3>
                            <button class="dropdown-button" type="button" onclick='showElement("exercise-type-<?= $key; ?>")'>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                                    <path d="M8 10.293l4.646-4.647a.5.5 0 0 1 .708.708l-5 5a.5.5 0 0 1-.708 0l-5-5a.5.5 0 1 1 .708-.708L8 10.293z" fill="#757575" fill-rule="evenodd" style="--darkreader-inline-fill: #9e9689;" data-darkreader-inline-fill=""></path>
                                </svg>
                            </button>
                        </div>
                        <div class="exercise-type-content exercise-type-<?= $key; ?>" style="display: none">
                            <?php foreach ($exerciseType as $key2=>$exercise): ?>
                                <input name="exercises[<?= $exercise; ?>][name]" type="checkbox" value="<?= $exercise; ?>" id="<?= $exercise; ?>" onclick='showElement("<?= str_replace(' ', '_', $exercise); ?>")'>
                                <label for="<?= $exercise; ?>" ><?= $exercise; ?></label>
                                <div class="<?= str_replace(' ', '_', $exercise); ?>" style="display: none">
                                    <label for="<?= $exercise; ?>-details">Exercise details</label>
                                    <textarea name="exercises[<?= $exercise; ?>][details]" id="<?= $exercise; ?>-details" cols="13" rows="2"></textarea>
                                    <label for="<?= $exercise; ?>-sets">Sets </label>
                                    <input type="number" id="<?= $exercise; ?>-sets" name="exercises[<?= $exercise; ?>][sets]" min="1" max="15">
                                    <label for="<?= $exercise; ?>-reps">Reps </label>
                                    <input type="number" id="<?= $exercise; ?>-reps" name="exercises[<?= $exercise; ?>][reps]" min="1" max="50">
<!--                                    TODO: inputs and textarea required only if checkbox checked -->
                                </div>
                                <br>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="add-workout-btn">
                    <input type="submit" value="Add workout">
                </div>
                <div class="messages">
                    <?php
                    if(isset($messages)) {
                        foreach ($messages as $message) {
                            echo $message;
                        }
                    }
                    ?>
                </div>
            </form>
        </div>
    </section>
    <?php
        include('elements/footer-logged-in.php');
    ?>
</body>
</html>
