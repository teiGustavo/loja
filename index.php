<?php

require __DIR__ . "/vendor/autoload.php";

use CoffeeCode\Router\Router;

$router = new Router(URL_BASE);

//Define o namespace dos Controllers
$router->namespace("Loja\Controllers");

$router->get("/", "HomeController:index", "loja.home");

$router->group("produtos");
$router->get("/", "ProductController:index", "loja.produtos");
$router->post("/create", "ProductController:createProduct", "loja.cadastrar.produto");
$router->post("/delete", "ProductController:deleteProduct", "loja.excluir.produto");
$router->post("/update", "ProductController:updateProduct", "loja.editar.produto");
$router->post("/ajax", "ProductController:ajax", "loja.ajax.produto");

$router->group("produtos/categorias");
$router->get("/", "CategoryController:index", "loja.categorias");
$router->post("/create", "CategoryController:createCategory", "loja.cadastrar.categoria");
$router->post("/delete", "CategoryController:deleteCategory", "loja.excluir.categoria");
$router->post("/update", "CategoryController:editCategory", "loja.editar.categoria");

$router->group("clientes");
$router->get("/", "CustomerController:index", "loja.clientes");

//$router->get("/pagamento", "CustomerController:index", "loja.formapagamento");

//Responsável por despachar as rotas
$router->dispatch();

//Verifica se houve alguma requisição via GET de algum erro HTTP
if ($router->error())
    //Caso tenha ocorrido, redireciona para o respectivo erro HTTP
    $router->redirect("/error/{$router->error()}");