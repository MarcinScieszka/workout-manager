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

        if (filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL) == false) {
            return $this->render('login', ['messages' => ['Wrong email format!']]);
        }

        $user = $userRepository->getUser($_POST["email"]);
        
        if(!$user) {
            return $this->render('login', ['messages' => ['Wrong email or password!']]);
        }

        if (!password_verify($_POST["password"], $user->getPassword())) {
            return $this->render('login', ['messages' => ['Wrong email or password!']]);
        }

//        TODO: after bad attempt, display provided email

        session_start();
        $_SESSION["user"] = htmlspecialchars($_POST['email']);

//        setcookie("user", htmlspecialchars($_POST['email']), time() + 120, "/"); // TODO: increase time

//        TODO: redirect when trying to manually go to /dashboard

//        $url = "http://$_SERVER[HTTP_HOST]";
//        header("Location: {$url}/dashboard");
//        exit();
        $this->render('dashboard');
    }

    public function register() {
        $userRepository = new UserRepository();

        if (!$this->isPost()) {
            return $this->render('register');
        }

        if (!filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) {
            return $this->render('register', ['messages' => ['Wrong email format!']]);
        }

        //        TODO: check if email is already used

        if ($_POST["password"] != $_POST["confirm-password"]) {
            return $this->render('register', ['messages' => ['Passwords do not match!']]);
        }

//        TODO: after bad attempt, display provided email

//        TODO: add requirement for special symbols in password

        $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

        $userRepository->addUser($_POST["email"] , $password);

        return $this->render('login');
    }

    function logout() {
//        setcookie("user", "", time() - 3600);
        session_destroy();
    }
}
