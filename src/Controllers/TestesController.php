<?php

namespace Loja\Controllers;

use CoffeeCode\DataLayer\Connect;
use Loja\Models\Customer;
use Loja\Models\Order;
use Loja\Models\Product;

class TestesController extends MainController
{

    public function index(): void
    {
        $params = [];

        //Renderiza a página (view Home)
        echo $this->view->render("testes", $params);
    }
}