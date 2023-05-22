<?php

require __DIR__ . "/vendor/autoload.php";

use CoffeeCode\Router\Router;
use Loja\Middlewares\AuthMiddleware;

$router = new Router(URL_BASE);

//Define o namespace dos Controllers
$router->namespace("Loja\Controllers");

$router->group("", AuthMiddleware::class);
$router->get("/", "HomeController:index", "home");

$router->group("/form", AuthMiddleware::class);
$router->post("/create", "FormController:create", "form.create");
$router->post("/update", "FormController:update", "form.update");
$router->post("/delete", "FormController:delete", "form.delete");

$router->group("products", AuthMiddleware::class);
$router->get("/", "ProductController:index", "products");
$router->post("/create", "ProductController:createProduct", "product.create");
$router->post("/delete", "ProductController:deleteProduct", "product.delete");
$router->post("/update", "ProductController:updateProduct", "product.update");

$router->group("products/categories", AuthMiddleware::class);
$router->get("/", "CategoryController:index", "categories");
$router->post("/create", "CategoryController:create", "category.create");
$router->post("/update", "CategoryController:update", "category.update");
$router->post("/delete", "CategoryController:delete", "category.delete");

$router->group("customers", AuthMiddleware::class);
$router->get("/", "CustomerController:index", "customers");
$router->post("/create", "CustomerController:createCustomer", "customer.create");
$router->post("/delete", "CustomerController:deleteCustomer", "customer.delete");
$router->post("/update", "CustomerController:updateCustomer", "customer.update");

$router->group("orders", AuthMiddleware::class);
$router->get("/", "OrderController:index", "orders");
$router->post("/create", "OrderController:createOrder", "order.create");
$router->post("/delete", "OrderController:deleteOrder", "order.delete");
$router->post("/update", "OrderController:updateOrder", "order.delete");

$router->group("payment-method", AuthMiddleware::class);
$router->get("/", "PaymentController:index", "payment-methods");
$router->post("/create", "PaymentController:createPayment", "payment-method.create");
$router->post("/delete", "PaymentController:deletePayment", "payment-method.delete");
$router->post("/update", "PaymentController:updatePayment", "payment-method.update");

$router->group("auth");
$router->get("/sign-in", "AuthController:signIn", "auth.sign-in");
$router->get("/sign-up", "AuthController:signUp", "auth.sign-up");
$router->get("/logout", "AuthController:logout", "auth.logout");
$router->post("/sign-in/authenticate", "AuthController:authenticate", "auth.authenticate");

$router->dispatch();

if ($router->error())
    $router->redirect("/error/{$router->error()}");