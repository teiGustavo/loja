<?php

namespace Loja\Controllers;
use League\Plates\Engine;

abstract class MainController
{
    protected $router;
    protected $view;

    public function __construct($router, $globals = [], $dir = null, $model = null)
    {
        //Define o diretório da localização das views (templates)
        $dir = $dir ?? dirname(__DIR__, 2) . "/views/";

        //Instancia o objeto das views (Plates)
        $this->view = new Engine($dir);

        //Define o roteador
        $this->router = $router;

        //Adiciona o roteador globalmente a todos os Controllers que extendam o MainController
        $this->view->addData([
            "router" => $this->router,
            "title_prefix" => TITLE_PREFIX
        ]);

        if ($globals)
            $this->view->addData($globals);
    }
}