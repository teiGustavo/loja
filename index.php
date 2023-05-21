<?php

require __DIR__ . "/vendor/autoload.php";

use CoffeeCode\Router\Router;
use Loja\Middlewares\AuthMiddleware;

$router = new Router(URL_BASE);

//Define o namespace dos Controllers
$router->namespace("Loja\Controllers");

$router->group("", AuthMiddleware::class);
$router->get("/", "HomeController:index", "loja.home");

$router->group("/form", AuthMiddleware::class);
$router->post("/create", "FormController:create", "form.create");
$router->post("/update", "FormController:update", "form.update");
$router->post("/delete", "FormController:delete", "form.delete");

$router->group("produtos", AuthMiddleware::class);
$router->get("/", "ProductController:index", "loja.produtos");
$router->post("/create", "ProductController:createProduct", "loja.cadastrar.produto");
$router->post("/delete", "ProductController:deleteProduct", "loja.excluir.produto");
$router->post("/update", "ProductController:updateProduct", "loja.editar.produto");

$router->group("produtos/categorias", AuthMiddleware::class);
$router->get("/", "CategoryController:index", "loja.categorias");
$router->post("/create", "CategoryController:create", "category.create");
$router->post("/update", "CategoryController:update", "category.update");
$router->post("/delete", "CategoryController:delete", "category.delete");

$router->group("clientes", AuthMiddleware::class);
$router->get("/", "CustomerController:index", "loja.clientes");
$router->post("/create", "CustomerController:createCustomer", "loja.cadastrar.cliente");
$router->post("/delete", "CustomerController:deleteCustomer", "loja.excluir.cliente");
$router->post("/update", "CustomerController:updateCustomer", "loja.editar.cliente");

$router->group("vendas", AuthMiddleware::class);
$router->get("/", "OrderController:index", "loja.vendas");
$router->post("/create", "OrderController:createOrder", "loja.cadastrar.venda");
$router->post("/delete", "OrderController:deleteOrder", "loja.excluir.venda");
$router->post("/update", "OrderController:updateOrder", "loja.editar.venda");

$router->group("formaspgto", AuthMiddleware::class);
$router->get("/", "PaymentController:index", "loja.formaspgto");
$router->post("/create", "PaymentController:createPayment", "loja.cadastrar.formapgto");
$router->post("/delete", "PaymentController:deletePayment", "loja.excluir.formapgto");
$router->post("/update", "PaymentController:updatePayment", "loja.editar.formapgto");

$router->group("auth");
$router->get("/sign-in", "AuthController:signIn", "loja.auth.logar");
$router->get("/sign-up", "AuthController:signUp", "loja.auth.cadastrar");
$router->get("/logout", "AuthController:logout", "loja.auth.sair");
$router->post("/sign-in/authenticate", "AuthController:authenticate", "loja.auth.authenticate");

//Responsável por despachar as rotas
$router->dispatch();

//Verifica se houve alguma requisição via GET de algum erro HTTP
if ($router->error())
    //Caso tenha ocorrido, redireciona para o respectivo erro HTTP
    $router->redirect("/error/{$router->error()}");