<?php

namespace Loja\Controllers;
use Loja\Models\Customer;
use Loja\Models\Payment;
use Loja\Models\Order;
use Loja\Models\Product;

class HomeController extends MainController
{
    public function getOrdersQuantity(): int
    {
        $model = new Order();
        $countOrders = $model->find()->count();

        return $countOrders;
    }

    public function getProductsQuantity(): int
    {
        $model = new Product();
        $countProducts = $model->find()->count();

        return $countProducts;
    }

    public function getCustomersQuantity(): int
    {
        $model = new Customer();
        $countCustomers = $model->find()->count();

        return $countCustomers;
    }

    public function getMonthIncomes(): string
    {
        $now = date("m/Y");

        $model = new Order();
        $incomes = $model
            ->otherFind(
                "CONCAT('R$ ', REPLACE(REPLACE(REPLACE(FORMAT(SUM(OD.valor), 2),'.',';'),',','.'),';',',')) as valor", 
                "orders AS O JOIN order_details AS OD ON O.id = OD.venda", 
                "DATE_FORMAT(O.datavenda, '%m/%Y') = '$now'"
            )
        ->fetch()
        ->data()
        ->valor;

        return $incomes || "";
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

    public function testes()
    {
        $params = [];

        echo $this->view->render("testes", $params);
    }
}