<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';

class LoginController extends AppController {

    public function postLogin()
    {
        $userRepository = new UserRepository();

        if (!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $userRepository->getUser($email);

        if (!$user) {
            return $this->render('login', ['messages' => ['User not found!']]);
        }

        if ($user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ['User with this email not exist!']]);
        }

        if ($user->getPassword() !== $password) {
            return $this->render('login', ['messages' => ['Wrong password!']]);
        }

        $this->sessionManager->startSession($user);

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/index");
    }

    public function login()
    {
        $this->render("login");
    }

    public function logout()
    {
        $this->sessionManager->closeSession();
        $this->render("index");
    }
}