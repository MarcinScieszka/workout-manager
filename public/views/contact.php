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
    <title>Contact</title>
    <link rel="icon" type="image/x-icon" href="/public/img/favicon.ico">
    <link rel="stylesheet" href="/public/css/index.css">
    <link rel="stylesheet" href="/public/css/contact.css">
    <script type="text/javascript" src="/public/js/index.js" defer></script>
    <script type="text/javascript" src="/public/js/header.js" defer></script>
</head>
<body>
    <?php
        require_once('init.php');
    ?>
    <section>
        <div class="box content-flex-col">
            <div class="image-box content-flex-col">
            <?php if($message_sent): ?>
                <div class="thank-you-msg content-flex-col">
                    <h2>Thank you for the message!</h2>
                    <div class="go-back-btn">
                        <a href="/">Go back</a>
                    </div>
                </div>
            <?php else: ?>
                <form action="contact" method="POST">
                    <div class="content content-flex-col">
                        <h2>Send us a message</h2>
                        <div class="contact-grid">
                            <div class="contact-name content-flex-col">
                                <label for="name">Name</label>
                                <input id="name" name="name" type="text" required>
                            </div>
                            <div class="contact-email content-flex-col">
                                <label for="email">Email</label>
                                <input id="email" name="email" type="email" required>
                            </div>
                            <div class="contact-topic content-flex-col">
                                <label for="topic">Topic</label>
                                <input id="topic" name="topic" type="text" required>
                            </div>
                            <div class="contact-message content-flex-col">
                                <label for="contact-message">Message</label>
                                <textarea name="message" id="contact-message" rows="10" required></textarea>
                            </div>
                                <?php if(isset($messages)): ?>
                                    <div class="messages">
                                        <?php
                                            foreach ($messages as $message) {
                                                echo $message;
                                            }
                                        ?>
                                    </div>
                                    <br>
                                <?php endif; ?>
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
