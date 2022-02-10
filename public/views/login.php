<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
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
    <title>Login page</title>
    <link rel="icon" type="image/x-icon" href="/public/img/favicon.ico">
    <link rel="stylesheet" href="/public/css/index.css">
    <link rel="stylesheet" href="/public/css/login.css">
    <script type="text/javascript" src="/public/js/index.js" defer></script>
    <script type="text/javascript" src="/public/js/header.js" defer></script>
</head>
<body>
    <?php
        include('init.php');
    ?>
    <section>
        <div class="content">
            <h2>Log in to your account</h2>
            <form class="login-form" action="login" method="POST">
                <h3><label for="email">Email</label></h3>
                <input id="email" name="email" type="email" value="<?php if(isset($provided_email)){echo $provided_email;} ?>" required>
                <h3><label for="password">Password</label></h3>
                <input id="password" name="password" type="password" value="<?php if(isset($provided_password)){echo $provided_password;} ?>" required>
                <button class="action-btn" type="submit">Login</button>
            </form>
            <div class="messages">
                <?php
                    if(isset($messages)) {
                        foreach ($messages as $message) {
                            echo $message;
                        }
                    }
                ?>
            </div>
            <h4>Don't have an account?</h4>
            <a href="/register">Register</a>
        </div>
    </section>
    <?php
        include('elements/footer.php');
    ?>
</body>
</html>
