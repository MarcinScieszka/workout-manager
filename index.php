<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Router::get('', 'DefaultController');
Router::get('login', 'DefaultController');
Router::get('register', 'DefaultController');
Router::get('contact', 'DefaultController');
Router::get('dashboard', 'DefaultController');
Router::get('workouts', 'DefaultController');
Router::post('login', 'SecurityController');
Router::post('addWorkout', 'WorkoutController');
Router::post('register', 'SecurityController');
Router::run($path);
