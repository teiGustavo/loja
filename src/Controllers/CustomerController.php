<?php

namespace Loja\Controllers;

class CustomerController extends MainController
{
    public function index()
    {
        //Renderiza a página
        echo $this->view->render("clientes");
    }
}