<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['user'])) {
        header("Location: http://$_SERVER[HTTP_HOST]/");
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
    <link rel="stylesheet" href="/public/css/changePassword.css">
    <script type="text/javascript" src="/public/js/index.js" defer></script>
    <script type="text/javascript" src="/public/js/header.js" defer></script>
</head>
<body>
<?php include('init.php'); ?>
<section class="container content-flex-col">
    <?php if($successful): ?>
        <div class="content-flex-col">
            <h2>Password changed successfully</h2>
            <div class="go-back-btn">
                <a  href="/settings">Go back</a>
            </div>
        </div>
    <?php else: ?>
    <div class="change-password-dialog content-flex-col">
        <form action="changePassword" method="POST">
            <header>
                <h2>Change password</h2>
            </header>
            <div class="content-flex-col">
                <label for="password">Old password</label>
                <input name="password" id="password" type="password" value="<?php if(isset($provided_password)){echo $provided_password;} ?>" required>
                <label for="newPassword">New password</label>
                <input name="newPassword" id="newPassword" type="password" value="<?php if(isset($provided_new_password)){echo $provided_new_password;} ?>" required>
                <label for="confirmPassword">Confirm password</label>
                <input name="confirmPassword" id="confirmPassword" type="password" value="<?php if(isset($provided_confirm_password)){echo $provided_confirm_password;} ?>" required>
            </div>
            <div class="messages">
                <?php
                if(isset($messages)) {
                    foreach ($messages as $message) {
                        echo $message;
                    }
                }
                ?>
            </div>
            <footer>
                <a class="change-password-dialog-btn cancel-btn" href="/settings">Cancel</a>
                <button class="change-password-dialog-btn save-btn" type="submit">Save</button>
            </footer>
        </form>
    </div>
    <?php endif; ?>
</section>
<?php include('elements/footer.php'); ?>
</body>
</html>
