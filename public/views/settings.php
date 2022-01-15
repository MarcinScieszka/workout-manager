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
    <link rel="stylesheet" type="text/css" href="public/css/settings.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
</head>
<body>
    <?php include('init.php'); ?>
    <section class="container">
        <div class="personal-info">
            <h2>Personal info</h2>
                
            <h3>Email</h3>
            <h4> <?= $_SESSION['user']; ?> </h4>
        
            <h3>Name</h3>
            
            <h3>Gender</h3>
            
            <h3>Password</h3>
            <!-- TODO: password: last changed time -->
        </div>   
    </section>
    <?php
        include('elements/footer-logged-in.php');
    ?>
</body>
</html>
