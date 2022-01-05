<?php

require_once 'AppController.php';

class DefaultController extends AppController {
    public function homepage()
    {
        // displays homepage
        $this->render('homepage');
    }

    public function login()
    {
        // displays login page
        $this->render('login');
    }

    public function register() {
        $this->render('register');
    }

    public function contact() {
        $this->render('contact');
    }

    public function dashboard() {
        $this->render('dashboard');
    }

    public function workouts() {
        $this->render('workouts');
    }
}
