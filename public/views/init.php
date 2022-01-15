<?php
    if(isset($_SESSION['user'])) {
        include 'elements/header-logged-in.php';
    }
    else {
        include 'elements/header.php';
    }
