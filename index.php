<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Router::get('', 'DefaultController');
Router::post('contact', 'CommunicationController');
Router::post('login', 'SecurityController');
Router::post('logout', 'SecurityController');
Router::post('register', 'SecurityController');
Router::post('changePassword', 'SecurityController');
Router::get('dashboard', 'UserController');
Router::get('settings', 'UserController');
Router::get('workouts', 'WorkoutController');
Router::get('myWorkouts', 'WorkoutController');
Router::get('workout', 'WorkoutController');
Router::post('addWorkout', 'WorkoutController');
Router::post('assignWorkout', 'WorkoutController');
Router::post('completeWorkout', 'WorkoutController');
Router::post('search', 'WorkoutController');
Router::run($path);
