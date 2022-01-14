<?php
//    if (isset($_COOKIE['user'])) {
        if (isset($_SESSION["user"])) {
        include 'elements/header-logged-in.php';
            echo $_SESSION["user"];
        echo 'logged in!  ';
    }
    else {
        include 'elements/header.php';
        echo 'not logged in!';
    }
