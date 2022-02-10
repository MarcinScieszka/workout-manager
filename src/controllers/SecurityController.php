<?php

use JetBrains\PhpStorm\NoReturn;

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';
require_once __DIR__.'/../repository/SecurityRepository.php';

class SecurityController extends AppController
{
    public function login() {
        if (!$this->isPost()) {
            return $this->render('login');
        }

        $userRepository = new UserRepository();
        $securityRepository = new SecurityRepository();
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST["password"]);

        if (filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL) == false) {
            return $this->render('login', ['messages' => ['Wrong email format!'],
                'provided_email' => $email,
                'provided_password' => $password
                ]);
        }

        $user = $userRepository->getUser($email);
        if(!$user) {
            return $this->render('login', ['messages' => ['Wrong email or password!'],
                'provided_email' => $email,
                'provided_password' => $password
            ]);
        }

        if(!password_verify($password, $user->getPassword())) {
            $securityRepository->login($email, false);
            return $this->render('login', ['messages' => ['Wrong email or password!'],
                'provided_email' => $email,
                'provided_password' => $password
            ]);
        }

        if(session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['user'] = $email;
        $_SESSION['user_id'] = $userRepository->getUserId($email);

        $securityRepository->login($email, true);

        header("Location: http://$_SERVER[HTTP_HOST]/dashboard");
        exit();
    }

    public function register() {
        if(!$this->isPost()) {
            return $this->render('register');
        }

        $userRepository = new UserRepository();
        $email = $_POST["email"];
        $gender = $_POST["gender"];
        $password = $_POST["password"];
        $password_conf = $_POST['confirm-password'];

        if (!filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) {
            return $this->render('register', ['messages' => ['Wrong email format!'],
                'provided_email' => $email,
                'provided_password' => $password,
                'provided_password_conf' => $password_conf
            ]);
        }
        if ($userRepository->checkIfUserExists($email) == true) {
            return $this->render('register', ['messages' => ['Email already used!'],
                'provided_email' => $email,
                'provided_password' => $password,
                'provided_password_conf' => $password_conf
            ]);
        }

        $password_pattern = ' ((?=.*[A-Z])(?=.*[a-z])(?=.*\d).{7,200}) ';
        if(!preg_match($password_pattern, $password)) {
            return $this->render('register', ['messages' => ['Make sure your password is 8 characters long 
            and contains at least one: number, special character, lowercase letter and uppercase letter'],
                'provided_email' => $email,
                'provided_password' => $password
            ]);
        }
        if ($password != $_POST["confirm-password"]) {
            return $this->render('register', ['messages' => ['Passwords do not match!'],
                'provided_email' => $email,
                'provided_password' => $password
            ]);
        }
        $password = password_hash($password, PASSWORD_BCRYPT);

        $userRepository->addUser($email , $password, $gender);

        return $this->render('login');
    }

    public function logout() {
        if (!$this->isPost()) {
            header("Location: http://$_SERVER[HTTP_HOST]/");
            exit();
        }

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $securityRepository = new SecurityRepository();
        $securityRepository->logout($_SESSION['user_id']);

        session_unset();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();

        header("Location: http://$_SERVER[HTTP_HOST]/login");
        exit();
    }

    public function changePassword() {
        if (!$this->isPost()) {
            return $this->render('changePassword', ['successful' => false]);
        }
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $userRepository = new UserRepository();
        $password = htmlspecialchars($_POST["password"]);
        $newPassword = htmlspecialchars($_POST["newPassword"]);
        $confirmPassword = htmlspecialchars($_POST["confirmPassword"]);

        $user = $userRepository->getUser($_SESSION['user']);
        if (!password_verify($password, $user->getPassword())) {
            return $this->render('changePassword', ['successful' => false, 'messages' => ['Wrong password!'],
                'provided_new_password' => $newPassword,
                'provided_confirm_password' => $confirmPassword
            ]);
        }

        $password_pattern = ' ((?=.*[A-Z])(?=.*[a-z])(?=.*\d).{7,200}) ';
        if(!preg_match($password_pattern, $password)) {
            return $this->render('register', ['messages' => ['Make sure your password is 8 characters long 
            and contains at least one: number, special character, lowercase letter and uppercase letter'],
                'provided_new_password' => $newPassword
            ]);
        }

        if ($newPassword != $confirmPassword) {
            return $this->render('changePassword', ['successful' => false, 'messages' => ['Passwords do not match!'],
                'provided_password' => $password,
                'provided_new_password' => $newPassword,
                'provided_confirm_password' => $confirmPassword
            ]);
        }

        $newPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        $userRepository->changeUserPassword($_SESSION['user'], $newPassword);

        return $this->render('changePassword', ['successful' => true]);
    }
}
