<?php

namespace Loja\Middlewares;

use CoffeeCode\Router\Router;

class AuthMiddleware
{
    public $router;

    //Teste de implementação de um controlador da rota de login
    public function handle(Router $router)
    {
        $this->router = $router;
        
        //Verifica se o usuário não está autenticado
        if ($_SESSION["logged"] == false) {
            //Caso verdadeiro, é feito um redirecionamento para a rota da Home
            return $router->redirect("loja.auth.logar");
        }

        //Continua a rota requisitada caso esteja devidamente autenticado
        return $router->current();
    }
}