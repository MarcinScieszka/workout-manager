<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/index.css">
    <link rel="stylesheet" type="text/css" href="public/css/login.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
</head>
<body>
    <?php
        include('header.php');
    ?>
    
    <section>
        <div class="content">
            <h2>Login</h2>
            <form action="login" method="POST">
                <input name="email" type="email" placeholder="Email" required>
                <input name="password" type="password" placeholder="Password" required>
                <button type="submit">Login</button>
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
            <h3>Do not have an account?</h3>
            <a href="/register">Register</a>
    </section>

    <?php
        include('footer.php');
    ?>
</body>
</html>
