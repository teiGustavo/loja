<?php

namespace Loja\Controllers;

use Loja\Models\Category;

class CategoryController extends MainController
{
    public function getCategories(): array
    {
        $model = new Category();
        $categories = $model->find("", "", "codigo_categoria, nome, date_format(data_cadastro, '%d/%m/%Y') as data_cadastro")->fetch(true);

        return $categories != null ? $categories : [];
    }

    public function index(): void
    {
        $categories = $this->getCategories();

        $params = [
            "categories" => $categories
        ];

        //Renderiza a página (view Categorias)
        echo $this->view->render("categorias", $params);
    }

    public function createCategory(array $data): void
    {
        $categoryName = filter_var($data["name"], FILTER_SANITIZE_STRING);

        $category = new Category();
        $category->nome = $categoryName;
        $category->save();
    }

    public function deleteCategory(array $data): void
    {
        $categoryId = filter_var($data["id"], FILTER_SANITIZE_NUMBER_INT);

        $category = (new Category())->findById($categoryId);
        $category->destroy();
    }

    public function editCategory(array $data): void
    {
        $categoryId = filter_var($data["id"], FILTER_SANITIZE_NUMBER_INT);
        $categoryName = filter_var($data["name"], FILTER_SANITIZE_STRING);

        $category = (new Category())->findById($categoryId);
        $category->nome = $categoryName;
        $category->save();
    }
}