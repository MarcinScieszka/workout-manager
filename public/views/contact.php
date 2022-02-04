<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/index.css">
    <link rel="stylesheet" type="text/css" href="public/css/contact.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
</head>
<body>
    <?php
        require_once('init.php');
    ?>
    <section>
        <div class="box">
            <div class="image-box">
            <?php if($message_sent): ?>
                <div class="thank-you-msg content-flex-col">
                    <h2>Thank you for the message!</h2>
                    <div class="go-back-btn">
                        <a href="/">Go back</a>
                    </div>
                </div>
            <?php else: ?>
                <form action="contact" method="POST">
                    <div class="content">
                        <h2>Send us a message</h2>
                        <div class="contact-grid">
                            <input name="name" type="text" placeholder="Name" required>
                            <input name="email" type="email" placeholder="Email" required>
                            <input name="topic" type="text" placeholder="Topic" required>
                            <textarea name="message" id="contact-message" rows="10" placeholder="Message" required></textarea>
                            <div class="messages">
                                <?php
                                if(isset($messages)) {
                                    foreach ($messages as $message) {
                                        echo $message;
                                    }
                                }
                                ?>
                            </div>
                            <br>
                            <input class="form-btn" name="submit" type="submit" value="Submit">
                        </div>
                    </div>
                </form>
            <?php endif; ?>
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
