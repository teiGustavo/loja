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
            ->find(
                "",
                "",
                "codigo_produto, nome, CONCAT('R$ ', REPLACE(REPLACE(REPLACE(FORMAT(preco, 2),'.',';'),',','.'),';',',')) as preco, quantidade, 
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

        $callback["product"] = $product->data();

        echo json_encode($callback);
    }

    public function update(array $data): void
    {
        $productId = filter_var($data["id"], FILTER_SANITIZE_NUMBER_INT);
        $productName = filter_var($data["name"], FILTER_SANITIZE_STRING);
        $productPreco = filter_var($data["price"], FILTER_SANITIZE_STRING);
        $productQuantidade = filter_var($data["qtd"], FILTER_SANITIZE_NUMBER_INT);
        $productCategoria = filter_var($data["category"], FILTER_SANITIZE_NUMBER_INT);

        $productPreco = str_replace(["R$", "."], "", $productPreco);
        $productPreco = str_replace(",", ".", $productPreco);

        $product = (new Product())->findById($productId);
        $product->nome = $productName;
        $product->preco = $productPreco;
        $product->quantidade = $productQuantidade;
        $product->categoria = $productCategoria;

        if (!$product->save())
            echo json_encode($product->fail()->getMessage());
    }
}