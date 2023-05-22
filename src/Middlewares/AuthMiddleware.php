<?php

namespace Loja\Middlewares;

use CoffeeCode\Router\Router;

class AuthMiddleware
{
    public $router;

    private function validateJWT(): bool
    {
        //Função que inicializa as sessões (Presente no Config.php)
        initializeSessions();

        //Recupera o token salvo no cookie ou sessão
        if (!isset($_SESSION["token"]) || $_SESSION["token"] == "") {
            $this->router->redirect("auth.sign-in");
        }

        $jwt = $_SESSION["token"];

        //Separa a string pelo "." e converte o token em array (String para Array)
        $jwt = explode(".", $jwt);

        //Define o header (1), payload (2) e assinatura(3)
        $header = $jwt[0];
        $payload = $jwt[1];
        $signature = $jwt[2];

        $validateSignature = base64_encode(hash_hmac('sha256', "$header.$payload", JWT_KEY, true));

        if ($signature == $validateSignature) {
            $data = json_decode(base64_decode($payload));

            if ($data->exp > time()) {
                return true;
            }

            return false;
        }

        return false;
    }

    //Método responsável por verificar se o usuário está autenticado
    private function isAuth(): bool
    {
        //Verifica se o token do usuário é valido e se ele está logado
        if ($this->validateJWT()) {
            return true;
        }

        //Retorna falso caso o usuário não tenha feito login
        return false;
    }

    //Teste de implementação de um controlador da rota de login
    public function handle(Router $router)
    {
        $this->router = $router;

        //Verifica se o usuário não está autenticado
        if ($this->isAuth() == false) {
            //Caso não esteja, é feito um redirecionamento para a rota de login
            return $router->redirect("auth.sign-in");
        }

        //Continua a rota requisitada caso esteja devidamente autenticado
        return $router->current();
    }
}