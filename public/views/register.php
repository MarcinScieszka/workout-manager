<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/index.css">
    <link rel="stylesheet" type="text/css" href="public/css/login.css">
    <script type="text/javascript" src="./public/js/script.js" defer></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
</head>
<body>
    <?php
        include('header.php');
    ?>
    
    <section>
        <div class="content">
            <form action="register" method="POST">
                <h2>Sign up</h2>
                <input name="email" type="email" placeholder="Email">
                <input name="password" type="password" placeholder="Password">
                <input name="confirm-password" type="password" placeholder="Confirm Password">
                <button type="submit">Register</button>
                <div class="messages">
                    <?php
                    if(isset($messages)) {
                        foreach ($messages as $message) {
                            echo $message;
                        }
                    }
                    ?>
            </form>
                </div>
                <h3>Already have an account?</h3>
                <a href="/login">Login</a>

    </section>

    <?php
        include('footer.php');
    ?>
</body>
</html>