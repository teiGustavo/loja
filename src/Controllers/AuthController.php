<?php

namespace Loja\Controllers;
use Loja\Models\User;

class AuthController extends MainController
{
    public function __construct($router)
    {
        $dir = dirname(__DIR__, 2) . "/views/pages/auth/";

        parent::__construct($router, [], $dir);
    }


    public function signIn(): void
    {
        $params = [

        ];

        //Renderiza a página (view Home)
        echo $this->view->render("signin", $params);
    }

    public function signUp(): void
    {
        $params = [

        ];

        //Renderiza a página (view Home)
        echo $this->view->render("signup", $params);
    }

    public function validateEmail(string $email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }

        return false;
    }

    public function validatePassword(string $password)
    {
        if (filter_var($password, FILTER_DEFAULT) && strlen($password) >= 8) {
            return true;
        }

        return false;
    }

    public function authenticate(array $data): void
    {
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);

        if ($this->validateEmail($email) && $this->validatePassword($password)) {
            $params = http_build_query([
                "email" => $email,
                "password" => $password
            ]);

            $user = (new User())->find("email = :email AND senha = :password", $params);
            $userCount = $user->count();

            if ($userCount == 1) {
                $_SESSION["logged"] = 1;
                $this->router->redirect("loja.home");
            } else {
                $_SESSION["logged"] = 0;
                $this->router->redirect("loja.auth.logar");
            }
        }
    }
}