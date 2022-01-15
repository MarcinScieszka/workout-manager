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

        $email = htmlspecialchars($_POST['email']);

        $user = $userRepository->getUser($email);
        
        if(!$user) {
            return $this->render('login', ['messages' => ['Wrong email or password!']]);
        }

        $password = htmlspecialchars($_POST["password"]);

        if (!password_verify($password, $user->getPassword())) {
            return $this->render('login', ['messages' => ['Wrong email or password!']]);
        }

//        TODO: after bad attempt, display provided email

        session_start();
        $_SESSION['user'] = $email;

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/dashboard");
        exit();
    }

    public function register() {
        $userRepository = new UserRepository();

        if (!$this->isPost()) {
            return $this->render('register');
        }

        if (!filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) {
            return $this->render('register', ['messages' => ['Wrong email format!']]);
        }

        if ($userRepository->checkIfUserExists($_POST["email"]) == true) {
            return $this->render('register', ['messages' => ['Email already used!']]);
        }

        if ($_POST["password"] != $_POST["confirm-password"]) {
            return $this->render('register', ['messages' => ['Passwords do not match!']]);
        }

//        TODO: after bad attempt, display provided email

//        TODO: add requirement for special symbols in password

        $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

        $userRepository->addUser($_POST["email"] , $password);

        return $this->render('login');
    }

    public function logout() {
        if (!$this->isPost()) {
            return;
        }

        session_start();
        session_unset();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/login");
        exit();
    }
}
