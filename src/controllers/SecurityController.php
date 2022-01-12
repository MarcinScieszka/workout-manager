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

        $email = filter_input(INPUT_POST, email, FILTER_VALIDATE_EMAIL);
        if (empty(email)) {
            return $this->render('login', ['messages' => ['Wrong email or password!']]);
        }

        $password = $_POST["password"];

        $user = $userRepository->getUser($email);
        
        if(!$user) {
            return $this->render('login', ['messages' => ['Wrong email or password!']]); // user does not exist
        }

        if ($user->getPassword() != $password) {
            return $this->render('login', ['messages' => ['Wrong email or password!']]);
        }

//        $url = "http://$_SERVER[HTTP_HOST]";
//        header("Location: {$url}/dashboard");

        return $this->render('dashboard');

    }
}
