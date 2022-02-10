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
    <title>Register</title>
    <link rel="icon" type="image/x-icon" href="/public/img/favicon.ico">
    <link rel="stylesheet" href="/public/css/index.css">
    <link rel="stylesheet" href="/public/css/login.css">
    <link rel="stylesheet" href="/public/css/register.css">
    <script type="text/javascript" src="/public/js/registrationValidation.js" defer></script>
    <script type="text/javascript" src="/public/js/index.js" defer></script>
    <script type="text/javascript" src="/public/js/header.js" defer></script>
</head>
<body>
    <?php
        include('init.php');
    ?>
    <section>
        <div class="content">
            <form class="login-form" action="register" method="POST">
                <h2>Sign up</h2>
                <h3><label for="email">Email</label></h3>
                <input name="email" id="email" type="email" value="<?php if(isset($provided_email)){echo $provided_email;} ?>" required>
                <h3>Gender</h3>
                <div class="radio-gender">
                    <label for="male">Male</label>
                    <input type="radio" value="male" name="gender" id="male">
                    <label for="female">Female</label>
                    <input type="radio" value="female" name="gender" id="female">
                </div>
                <h3><label for="password">Password</label></h3>
                <input id="password" name="password" type="password" value="<?php if(isset($provided_password)){echo $provided_password;} ?>" required>
                <h3><label for="confirm-password">Confirm password</label></h3>
                <input id="confirm-password" name="confirm-password" type="password" value="<?php if(isset($provided_password_conf)){echo $provided_password_conf;} ?>" required>
                <button class="action-btn" type="submit">Register</button>
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
            <h4>Already have an account?</h4>
            <a href="/login">Log in</a>
        </div>
    </section>
    <?php
        include('elements/footer.php');
    ?>
</body>
</html>
