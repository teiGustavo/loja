<?php

namespace Loja\Controllers;

use Loja\Models\Category;

class CategoryController extends MainController
{
    public function getCategories(): array
    {
        $model = new Category;
        $categories = $model->find("", "", "codigo_categoria, nome, date_format(data_cadastro, '%d/%m/%Y') as data_cadastro")->fetch(true);

        return $categories;
    }

    public function index()
    {
        $categories = $this->getCategories();

        $params = [
            "categories" => $categories
        ];

        //Renderiza a página (view Categorias)
        echo $this->view->render("categorias", $params);
    }
}