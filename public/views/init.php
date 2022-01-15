<?php
    if(isset($_SESSION['user'])) {
        include 'elements/header-logged-in.php';
        echo $_SESSION['user'];
    }
    else {
        include 'elements/header.php';
    }
