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

    public function logout(): void
    {
        //Define a sessão ou cookie "logged" como falso
        initializeSessions(["token" => "", "logged" => false]); 
                
        //Retorna o usuário para a tela de login
        $this->router->redirect("auth.sign-in");
    }

    //Responsável por validar um email
    public function validateEmail(string $email): bool
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }

        return false;
    }

    //Responsável por validar uma senha
    public function validatePassword(string $password): bool
    {
        if (filter_var($password) && strlen($password) >= 8) {
            return true;
        }

        return false;
    }

    private function JWT(array $credentials): string
    {
        $expTime = time() + (60 * 60); //(Dias * Horas * Minutos * Segundos)

        //Cabeçalho do token (Primeira parte do token JWT)
        $header = [
            'alg' => 'HS256',
            'typ' => 'JWT'
        ];

        $header = base64_encode(json_encode($header));

        //Segunda parte do token JWT (Carga útil)
        $payload = [
            'iss' => URL_BASE,
            'aud' => URL_BASE,
            'exp' => $expTime,
            'id' => $credentials["id"],
            'email' => $credentials["email"],
            'username' => $credentials["username"]
        ];

        $payload = base64_encode(json_encode($payload));

        $signature = hash_hmac('sha256', "$header.$payload", JWT_KEY, true);
        $signature = base64_encode($signature);

        //Retorna o token JWT
        return "$header.$payload.$signature";
    }

    //Função que trata os dados oriundos do formulário de login
    public function authenticate(array $data): void
    {
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);

        if ($this->validateEmail($email) && $this->validatePassword($password)) {
            $params = http_build_query([
                "email" => $email,
                "password" => $password
            ]);

            //Procura o email e senha informados no BD
            $user = (new User())->find("email = :email AND senha = :password", $params)->fetch();

            //Verifica se o usuário foi encontrado
            if ($user) {
                //Informações a serem passadas pelo Token
                $credentials = [
                    "id" => $user->codigo_usuario,
                    "email" => $user->email,
                    "username" => $user->username
                ];

                //Instancia o método que retorna o token JWT
                $jwt = $this->JWT($credentials);

                //Define a sessão ou cookie do Token
                initializeSessions(["token" => $jwt, "logged" => true]);

                //Envia o usuário para a tela home
                $this->router->redirect("home");
            } else {
                $this->logout();
            }
        } else {
            $this->logout();
        }
    }
}