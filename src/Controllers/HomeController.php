<?php

namespace Loja\Controllers;

class HomeController extends MainController
{
    public function index()
    {
        //Renderiza a página (view Home)
        echo $this->view->render("home");
    }

    public function teste()
    {
        echo "<h1>Teste</h1>";
    }
}