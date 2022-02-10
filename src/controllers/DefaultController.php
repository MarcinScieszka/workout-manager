<?php

require_once 'AppController.php';

class DefaultController extends AppController {
    public function homepage() {
        return $this->render('homepage');
    }

    public function contact() {
        return $this->render('contact');
    }
}
