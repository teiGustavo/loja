<?php

namespace Loja\Controllers;

use Loja\Models\Category;
use Loja\Models\Product;

class ProductController extends MainController
{
    public $arrayProducts;

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

        return $products;
    }

    public function getCategories(): array
    {
        $categories = (new Category())->find()->fetch(true);

        return $categories;
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
        echo $this->view->render("produtos", $params);
    }

    public function createProduct(array $data): void
    {
        $productName = filter_var($data["name"], FILTER_SANITIZE_STRING);
        $productPreco = filter_var($data["price"], FILTER_SANITIZE_STRING);
        $productQuantidade = filter_var($data["qtd"], FILTER_SANITIZE_NUMBER_INT);
        $productCategoria = filter_var($data["category"], FILTER_SANITIZE_NUMBER_INT);

        $productPreco = str_replace(["R$", "."], "", $productPreco);
        $productPreco = str_replace(",", ".", $productPreco);

        $product = new Product();
        $product->nome = $productName;
        $product->preco = $productPreco;
        $product->quantidade = $productQuantidade;
        $product->categoria = $productCategoria;
        
        if (!$product->save())
            echo json_encode($product->fail()->getMessage());
    }

    public function deleteProduct(array $data): void
    {
        $productId = filter_var($data["id"], FILTER_SANITIZE_NUMBER_INT);

        $product = (new product())->findById($productId);

        if (!$product->destroy())
            echo json_encode($product->fail()->getMessage());
    }

    public function updateProduct(array $data): void
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