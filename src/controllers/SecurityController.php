<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';

class SecurityController extends AppController
{
    public function login() {
        $userRepository = new UserRepository();

        if (!$this->isPost()) {
            return $this->render('login');
        }

        if (!filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) {
            return $this->render('login', ['messages' => ['Wrong email format!']]);
        }

        $password = $_POST["password"];
        $user = $userRepository->getUser($_POST["email"]);
        
        if(!$user) {
            return $this->render('login', ['messages' => ['Wrong email or password!']]); // user does not exist
        }

        if ($user->getPassword() != $password) {
            return $this->render('login', ['messages' => ['Wrong email or password!']]);
        }

        return $this->render('dashboard');
    }

    public function register() {
        $userRepository = new UserRepository();

        if (!$this->isPost()) {
            return $this->render('register');
        }

        if (!filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) {
            return $this->render('register', ['messages' => ['Wrong email format!']]);
        }

        if ($_POST["password"] != $_POST["confirm-password"]) {
            return $this->render('register', ['messages' => ['Passwords do not match!']]);
        }

//        TODO: add requirement for special symbols in password

//        TODO: salt and hash password
//        password_hash()
        $password = $_POST["password"];

        $userRepository->addUser($_POST["email"] , $password);

        return $this->render('login');
    }
}
