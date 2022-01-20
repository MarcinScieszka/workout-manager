<?php
    session_start();
    if (isset($_SESSION['user'])) {
        header("Location: http://$_SERVER[HTTP_HOST]/dashboard");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/index.css">
    <link rel="stylesheet" type="text/css" href="public/css/login.css">
    <script type="text/javascript" src="/public/js/registrationValidation.js" defer></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
</head>
<body>
    <?php
        include('init.php');
    ?>
    <section>
        <div class="content">
            <form action="register" method="POST">
                <h2>Sign up</h2>
                <h3>Email</h3>
                <input name="email" type="email" value="<? if(isset($provided_email)){echo $provided_email;} ?>" required>
                <h3>Password</h3>
                <input name="password" type="password" value="<? if(isset($provided_password)){echo $provided_password;} ?>" required>
                <h3>Confirm password</h3>
                <input name="confirm-password" type="password" value="<? if(isset($provided_password_conf)){echo $provided_password_conf;} ?>" required>
                <button class="btn" type="submit">Register</button>
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
