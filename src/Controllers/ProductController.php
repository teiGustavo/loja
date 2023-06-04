<?php

namespace Loja\Controllers;

use Loja\Models\Category;
use Loja\Models\Product;

class ProductController extends MainController
{
    public function getProducts(): array
    {
        $model = new Product();
        $products = $model
            ->find(columns: "codigo_produto, nome, 
                CONCAT('R$ ', REPLACE(REPLACE(REPLACE(FORMAT(preco, 2),'.',';'),',','.'),';',',')) as preco, quantidade, 
                categoria, date_format(data_cadastro, '%d/%m/%Y') as data_cadastro"
            )
            ->fetch(true);

        return $products != null ? $products : [];
    }

    public function getCategories(): array
    {
        $categories = (new Category())->find()->fetch(true);

        return $categories != null ? $categories : [];
    }

    public function index(): void
    {
        $products = $this->getProducts();
        $categories = $this->getCategories();

        $params = [
            "products" => $products,
            "categories" => $categories
        ];

        //Renderiza a página (view Categorias)
        echo $this->view->render("products", $params);
    }

    public function create(array $data): void
    {
        $data = filter_var_array($data, FILTER_SANITIZE_STRING);

        if (in_array("", $data)) {
            $callback["message"] = "Por favor, informe todos os campos!";
            echo json_encode($callback);

            return;
        }

        $productPreco = str_replace(["R$", "."], "", $data["price"]);
        $productPreco = str_replace(",", ".", $productPreco);

        $product = new Product();
        $product->nome = $data["name"];
        $product->preco = $productPreco;
        $product->quantidade = $data["qtd"];
        $product->categoria = $data["category"];
        $product->save();

        $product = (new Product())
            ->find("", "", "codigo_produto, 
                nome, 
                CONCAT('R$ ', REPLACE(REPLACE(REPLACE(FORMAT(ROUND(preco, 2), 2),'.',';'),',','.'),';',',')) as preco, 
                quantidade, 
                date_format(data_cadastro, '%d/%m/%Y') as data_cadastro"
            )
            ->order("codigo_produto DESC")
            ->limit(1)
            ->fetch();

        $callback["message"] = "";
        $callback["product"] = $this->view->render("fragments/product", ["product" => $product]);

        echo json_encode($callback);
    }

    public function delete(array $data): void
    {
        if (empty($data["id"])) {
            return;
        }

        $id = filter_var($data["id"], FILTER_VALIDATE_INT);
        $callback["remove"] = false;

        $product = (new Product())->findById($id);

        if ($product) {
            if ($product->destroy()) {
                $callback["remove"] = true;
            } else {
                $callback["remove"] = false;
                $callback["messages"] = "Não foi possível excluir este campo!";
            }
        }

        echo json_encode($callback);
    }

    public function find(array $data): void
    {
        if (empty($data["id"])) {
            return;
        }

        $id = filter_var($data["id"], FILTER_VALIDATE_INT);

        $product = (new Product())->findById($id);
        $product->preco = number_format($product->preco, "2", ",", ".");

        $callback["product"] = $product->data();

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

        $product = (new Product())->findById($id);
        $product->nome = $data["name"];

        $productPreco = str_replace(["R$", "."], "", $data["price"]);
        $productPreco = str_replace(",", ".", $productPreco);
        $product->preco = $productPreco;

        $product->quantidade = $data["qtd"];
        $product->categoria = $data["category"];
        $product->save();

        $product = (new Product())
            ->findById($id, "codigo_produto, 
                nome, 
                CONCAT('R$ ', REPLACE(REPLACE(REPLACE(FORMAT(ROUND(preco, 2), 2),'.',';'),',','.'),';',',')) as preco, 
                quantidade, 
                date_format(data_cadastro, '%d/%m/%Y') as data_cadastro"
            );

        $callback["message"] = "";
        $callback["product"] = $this->view->render("fragments/product", ["product" => $product]);

        echo json_encode($callback);
    }
}