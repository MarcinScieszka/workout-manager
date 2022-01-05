<?php

require_once 'AppController.php';

class DefaultController extends AppController {
    public function homepage()
    {
        // displays homepage.html
        $this->render('homepage');
    }

    public function login()
    {
        // displays login.html
        $this->render('login');
    }

    public function register() {
        $this->render('register');
    }

    public function contact() {
        $this->render('contact');
    }
}
