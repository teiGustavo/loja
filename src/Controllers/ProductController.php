<?php

namespace Loja\Controllers;
use Loja\Models\Product;

class ProductController extends MainController
{
    public $arrayProducts;

    public function getProducts(): array
    {
        $model = new Product();
        $products = $model->find("", "", "codigo_produto, nome, CONCAT('R$ ', REPLACE(REPLACE(REPLACE(FORMAT(preco, 2),'.',';'),',','.'),';',',')) as preco, quantidade, date_format(data_cadastro, '%d/%m/%Y') as data_cadastro")->fetch(true);

        return $products;
    }

    public function ajax(array $data)
    {
        $productId = filter_var($data["id"], FILTER_VALIDATE_INT);
        
        $model = new Product();
        $product = $model->findById($productId);

        $array = [
            "id" => $productId,
            "name" => $product->nome,
            "price" => $product->preco,
            "qtd" => $product->quantidade,
            "category" => $product->categoria
        ];
    }

    public function index(): void
    {
        $products = $this->getProducts();
        $array = "";

        $params = [
            "products" => $products,
            "array" => $array
        ];

        //Renderiza a página (view Categorias)
        echo $this->view->render("produtos", $params);
    }

    public function createProduct(array $data): void
    {
        $productName = filter_var($data["name"], FILTER_SANITIZE_STRING);
        $productPreco = filter_var($data["price"], FILTER_VALIDATE_FLOAT);
        $productQuantidade = filter_var($data["qtd"], FILTER_VALIDATE_INT);
        $productCategoria = filter_var($data["category"], FILTER_VALIDATE_INT);

        $product = new Product();
        $product->nome = $productName;
        $product->preco = $productPreco;
        $product->quantidade = $productQuantidade;
        $product->quantidade = $productCategoria;
        $product->save();
    }

    public function deleteProduct(array $data): void
    {
        $productId = filter_var($data["id"], FILTER_VALIDATE_INT);

        $product = (new product())->findById($productId);
        $product->destroy();
    }

    public function updateProduct(array $data): void
    {
        $productId = filter_var($data["id"], FILTER_VALIDATE_INT);
        $productName = filter_var($data["name"], FILTER_SANITIZE_STRING);
        $productPreco = filter_var($data["price"], FILTER_VALIDATE_FLOAT);
        $productQuantidade = filter_var($data["qtd"], FILTER_VALIDATE_INT);
        $productCategoria = filter_var($data["category"], FILTER_VALIDATE_INT);

        $product = (new Product())->findById($productId);
        $product->nome = $productName;
        $product->preco = $productPreco;
        $product->quantidade = $productQuantidade;
        $product->categoria = $productCategoria;
        $product->save();
    }
}