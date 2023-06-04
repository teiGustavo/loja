<?php

namespace Loja\Controllers;

use CoffeeCode\DataLayer\Connect;
use Loja\Models\Customer;
use Loja\Models\Order;
use Loja\Models\Product;

class HomeController extends MainController
{
    public function getOrdersQuantity(): int
    {
        return (new Order())->find()->count();
    }

    public function getProductsQuantity(): int
    {
        return (new Product())->find()->count();
    }

    public function getCustomersQuantity(): int
    {
        return (new Customer())->find()->count();
    }

    public function getMonthIncomes(): string
    {
        $now = date("m/Y");

        $connect = Connect::getInstance();
        $error = Connect::getError();

        if ($error) {
            echo json_encode($error->getMessage());
            exit;
        }

        $orders = $connect
            ->query("SELECT CONCAT('R$ ', REPLACE(REPLACE(REPLACE(FORMAT(SUM(OD.valor), 2),'.',';'),',','.'),';',',')) AS valor
                    FROM orders AS O JOIN order_details AS OD ON O.id = OD.venda
                    WHERE DATE_FORMAT(O.datavenda, '%m/%Y') = '$now'" 
            );
            
        $incomes = $orders->fetch()->valor;

        return $incomes != "" ? $incomes : "R$ 0,00";
    }

    public function index(): void
    {
        $countOrders = $this->getOrdersQuantity();
        $countProducts = $this->getProductsQuantity();
        $countCustomers = $this->getCustomersQuantity();
        $countIncomes = $this->getMonthIncomes();

        $params = [
            "ordersQuantity" => $countOrders,
            "productsQuantity" => $countProducts,
            "customersQuantity" => $countCustomers,
            "monthIncomes" => $countIncomes
        ];

        //Renderiza a página (view Home)
        echo $this->view->render("home", $params);
    }
}