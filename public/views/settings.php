<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link rel="icon" type="image/x-icon" href="/public/img/favicon.ico">
    <link rel="stylesheet" href="/public/css/index.css">
    <link rel="stylesheet" href="/public/css/settings.css">
    <script type="text/javascript" src="/public/js/index.js" defer></script>
    <script type="text/javascript" src="/public/js/header.js" defer></script>
</head>
<body>
    <?php include('init.php'); ?>
    <section class="container content-flex-col">
        <div class="personal-info content-flex-col">
            <h2>Personal info</h2>
            <h3>Email</h3>
            <h4> <?= $user->getEmail(); ?> </h4>
            <h3>Gender</h3>
            <h4> <?= $user->getGender(); ?> </h4>
            <h3>Password</h3>
            <a class="change-password-btn" href="/changePassword">Change password</a>
        </div>
    </section>
    <?php
        include('elements/footer-logged-in.php');
    ?>
</body>
</html>
