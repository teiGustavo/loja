<?php

namespace Loja\Controllers;

use Loja\Models\Order;
use Loja\Models\Payment;

class OrderController extends MainController
{
    protected $model;

    public function __construct($router, $model = new Order())
    {
        parent::__construct($router);

        $this->model = $model;
    }

    public function getOrder(): array
    {
        $order = $this
            ->model
            ->find(
                "",
                "",
                "id, CONCAT(SUBSTR(cliente,1,3),'.',SUBSTR(cliente,4,3),'.',SUBSTR(cliente,7,3),'-',SUBSTR(cliente,10,2)) as cliente, 
                    formapgto, numparcelas, date_format(datavenda, '%d/%m/%Y') as datavenda"
            )
            ->fetch(true)
        ;

        return $order != null ? $order : [];
    }

    public function getMethodPayments(): array
    {
        $methods = (new Payment())->find()->fetch(true);

        return $methods != null ? $methods : [];
    }

    public function index(): void
    {
        $orders = $this->getOrder();
        $methodPayments = $this->getMethodPayments();

        $params = [
            "orders" => $orders,
            "methodPayments" => $methodPayments
        ];

        //Renderiza a página
        echo $this->view->render("vendas", $params);
    }

    public function createOrder(array $data): void
    {
        $orderCpf = filter_var($data["cpf"], FILTER_SANITIZE_STRING);
        $orderPaymentMethod = filter_var($data["paymentMethod"], FILTER_SANITIZE_NUMBER_INT);
        $orderParcelasQuantity = filter_var($data["quantity"], FILTER_SANITIZE_NUMBER_INT);

        $order = $this->model;
        $order->cliente = $orderCpf;
        $order->formapgto = $orderPaymentMethod;
        $order->numparcelas = $orderParcelasQuantity;

        if (!$order->save())
            echo json_encode($order->fail()->getMessage(), JSON_UNESCAPED_UNICODE); 

        echo json_encode($data, JSON_UNESCAPED_UNICODE); 
    }

    public function deleteOrder(array $data): void
    {
        $orderId = filter_var($data["id"], FILTER_SANITIZE_NUMBER_INT);

        $order = $this->model->findById($orderId);
        $order->destroy();
    }

    public function updateOrder(array $data): void
    {
        $orderId = filter_var($data["id"], FILTER_SANITIZE_NUMBER_INT);
        $orderCpf = filter_var($data["cpf"], FILTER_SANITIZE_STRING);
        $orderPaymentMethod = filter_var($data["paymentMethod"], FILTER_SANITIZE_NUMBER_INT);
        $orderParcelasQuantity = filter_var($data["quantity"], FILTER_SANITIZE_NUMBER_INT);

        $order = $this->model->findById($orderId);
        $order->cliente = $orderCpf;
        $order->formapgto = $orderPaymentMethod;
        $order->numparcelas = $orderParcelasQuantity;
        $order->save();
    }
}