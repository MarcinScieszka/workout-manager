<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/index.css">
    <link rel="stylesheet" type="text/css" href="public/css/login.css">
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
            <h2>Sign up</h2>
            <input name="email" type="email" placeholder="Email">
            <input name="password" type="password" placeholder="Password">
            <input name="confrm-password" type="password" placeholder="Confrm Password">
            <button type="submit">Register</button>
            <h3>Already have an account?</h3>
            <a href="/login">Login</a>
    </section>

    <?php
        include('footer.php');
    ?>
</body>
</html>