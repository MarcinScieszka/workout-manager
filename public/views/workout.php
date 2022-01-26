<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/index.css">
    <link rel="stylesheet" type="text/css" href="public/css/workout.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
</head>
<body>
<?php
require_once('init.php');
?>
<section class="container">
    <div class="content-flex-col">
        <div class="workout-details">
            <div style="font-size: 1.5rem; background-color: #3c3c3c; padding: 2rem">
                <?php echo "<pre>"; print_r($workout); echo "</pre>"; ?>
            </div>
        </div>
        <div class="go-back-btn">
            <a  href="/workouts">Go back</a>
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
</html>
