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
                <div class="content">
                    <h2>Send us a message</h2>
                    <div class="contact-grid">
                        <input name="name" type="text" placeholder="Name">
                        <input name="email" type="email" placeholder="Email">
                        <input name="topic" type="text" placeholder="Topic">
                        <textarea name="message" id="contact-message" rows="10" placeholder="Message"></textarea>
                    </div>
                    <input class="form-btn" name="submit" type="submit" value="Submit">
                </div>
            </div>

        </div>
    </section>

    <?php
        include('elements/footer.php');
    ?>
</body>
</html>
