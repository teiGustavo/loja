<?php

require __DIR__ . "/vendor/autoload.php";

use CoffeeCode\Router\Router;

$router = new Router(URL_BASE);

//Define o namespace dos Controllers
$router->namespace("Loja\Controllers");

$router->get("/", "HomeController:index", "loja.home");

$router->group("produtos");
$router->get("/categorias", "CategoryController:index", "loja.categorias");

$router->get("/clientes", "CustomerController:index", "loja.clientes");
$router->get("/pagamento", "CustomerController:index", "loja.formapagamento");

//Responsável por despachar as rotas
$router->dispatch();

//Verifica se houve alguma requisição via GET de algum erro HTTP
if ($router->error())
    //Caso tenha ocorrido, redireciona para o respectivo erro HTTP
    $router->redirect("/error/{$router->error()}");