<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Router::get('', 'DefaultController');
Router::get('workouts', 'WorkoutController');
Router::post('login', 'SecurityController');
Router::post('logout', 'SecurityController');
Router::post('register', 'SecurityController');
Router::post('addWorkout', 'WorkoutController');
Router::get('myWorkouts', 'WorkoutController');
Router::post('contact', 'CommunicationController');
Router::get('', 'DefaultController');
Router::get('dashboard', 'DefaultController');
Router::get('settings', 'DefaultController');
Router::get('test', 'DefaultController');
Router::run($path);
