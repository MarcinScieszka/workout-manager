<?php

require_once 'AppController.php';

class DefaultController extends AppController {
    public function homepage()
    {
        $this->render('homepage');
    }

    public function contact() {
        $this->render('contact');
    }

    public function settings() {
        $this->render('settings');
    }

    public function test() {
        $this->render('test');
    }
}
