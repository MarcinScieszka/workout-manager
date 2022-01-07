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
    <header>
        <div class="header-item">
            <a href="/"><img src="public/img/logo_text.svg" alt="Workager logo" id="logo"></a>
        </div>
        <div class="header-item header-item-btn">
            <a href="/plans">Plans</a>
        </div>
        <div class="header-item header-item-btn">
            <a href="/workouts">Workouts</a>
        </div>
        <div class="header-item header-item-btn">
            <a href="/contact">Contact</a>
        </div>
        <div class="header-item header-item-btn">
            <a href="/login">Login</a>
        </div>
    </header>
    
    <section>
        <div class="content">
            <h2>Login</h2>

            <form action="login" method="POST">
                <input name="email" type="email" placeholder="Email">
                <input name="password" type="password" placeholder="Password">
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

    <footer>
        <div class="footer-grid">
            <div class="footer-btn">
                <a href="/register">Register</a>
            </div>
            <div class="footer-btn">
                <a href="/login">Login</a>
            </div>
            <div class="footer-btn">
                <a href="/plans">Plans</a>
            </div>
            <div class="footer-btn">
                <a href="/workouts">Workouts</a>
            </div>
            <div class="footer-btn">
                <a href="/about">About us</a>
            </div>
            <div class="footer-btn">
                <a href="/contact">Contact</a>
            </div>
            <div class="footer-btn">
                <a href="/"><img src="public/img/logo_round.svg" alt="Workager round logo" id="logo-round"></a>
            </div>
        </div>
    </footer>
    <div class="copyright-box">
        <div class="copyright">
            <h5>Copyright &copy; 2022 Workager</h5>
        </div>
    </div>
</body>
</html>