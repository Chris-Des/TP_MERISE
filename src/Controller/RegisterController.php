<?php

namespace App\src\Controller;

use App\src\Entity\User;
use App\src\Controller\TwigController;

class RegisterController extends TwigController
{

    public function index()
    {
        if (isset($_POST['btnRegister']) && $_POST["btnRegister"] === "S'inscrire") {

            if (isset($_POST['email']) && !empty($_POST['email'])) {
                $username = htmlspecialchars($_POST['username']);
                $email = htmlspecialchars($_POST['email']);
            }
            if (isset($_POST['password']) && !empty($_POST['password'])) {
                $password = htmlspecialchars($_POST['password']);
                $passHash = password_hash($password, PASSWORD_BCRYPT);
            }
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $user = new User();
                $token = $user->generateCSRFToken();
                $user->username = $username;
                $user->email = $email;
                $user->password = $passHash;
                $user->token = $token;
                if ($user->addUser()) {

                    $user->email = $email;
                    $getUser = $user->getUserMail();

                    $_SESSION['email'] = $getUser->email;
                    $_SESSION['token'] = $getUser->token;
                    $_SESSION['id'] = $getUser->id;
                    $_SESSION['role'] = $getUser->role;
                    header("Location: home");
                }
            }
        }
        echo $this->twig->render("register/index.html.twig", []);
    }
}
