<?php

/** @noinspection PhpUndefinedFieldInspection */
/** @noinspection PhpUnused */
/** @noinspection PhpUndefinedVariableInspection */

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
        echo $this->view->render("categories", $params);
    }

    public function create(array $data): void
    {
        $data = filter_var_array($data, FILTER_SANITIZE_STRING);

        if (in_array("", $data)) {
            $callback["message"] = "Por favor, informe todos os campos!";
            echo json_encode($callback);

            return;
        }

        $category = new Category();
        $category->nome = $data["nome"];
        $category->save();

        $category = (new Category())
            ->find("", "", "codigo_categoria, nome, date_format(data_cadastro, '%d/%m/%Y') as data_cadastro")
            ->order("codigo_categoria DESC")
            ->limit(1)
            ->fetch();

        $callback["message"] = "";
        $callback["category"] = $this->view->render("fragments/category", ["category" => $category]);
        echo json_encode($callback);
    }

    public function update(array $data): void
    {
        if (empty($data["id"])) {
            return;
        }

        $id = filter_var($data["id"], FILTER_VALIDATE_INT);
        $data = filter_var_array($data, FILTER_SANITIZE_STRING);

        if (in_array("", $data)) {
            $callback["message"] = "Por favor, informe todos os campos!";
            echo json_encode($callback);

            return;
        }

        $category = (new Category())->findById($id);
        $category->nome = $data["nome"];
        $category->save();

        $category = (new Category())->findById($id, "codigo_categoria, nome, date_format(data_cadastro, '%d/%m/%Y') as data_cadastro");

        $callback["message"] = "";
        $callback["category"] = $this->view->render("fragments/category", ["category" => $category]);

        echo json_encode($callback);
    }

    public function delete(array $data): void
    {
        if (empty($data["id"])) {
            return;
        }

        $id = filter_var($data["id"], FILTER_VALIDATE_INT);

        $category = (new Category())->findById($id);
        if ($category) {
            if ($category->destroy()) {
                $callback["remove"] = true;
            } else {
                $callback["remove"] = false;
                $callback["messages"] = "Não foi possível excluir este campo!";
            }
        }

        echo json_encode($callback);
    }
}