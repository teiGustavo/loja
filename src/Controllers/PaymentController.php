<?php

namespace Loja\Controllers;

class PaymentController extends MainController
{
    public function index()
    {
        //Renderiza a página
        echo $this->view->render("formas_pagamento");
    }
}