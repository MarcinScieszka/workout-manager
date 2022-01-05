<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';

class SecurityController extends AppController
{
    public function login() {
        $user = new User('example@mail.com', 'admin', 'Adam', 'Johnson');

        if (!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_POST["email"];
        $password = $_POST["password"];

        if (($user->getEmail() != $email) || ($user->getPassword() != $password)) {
            return $this->render('login', ['messages' => ['Wrong email or password!']]);
        }

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/dashboard");
    }
}
