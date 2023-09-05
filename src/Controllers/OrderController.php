<?php

namespace Loja\Controllers;

use Loja\Models\Customer;
use Loja\Models\Order;
use Loja\Models\OrderDetails;
use Loja\Models\Payment;
use Loja\Models\Product;

class OrderController extends MainController
{
    public function __construct(
        $router,
        protected Order $model = new Order()
    ) {
        parent::__construct($router);
    }

    public function getOrder(): array
    {
        $order = $this
            ->model
            ->find(
                columns: "id, CONCAT(SUBSTR(cliente,1,3),'.',SUBSTR(cliente,4,3),'.',
                SUBSTR(cliente,7,3),'-',SUBSTR(cliente,10,2)) as cliente, 
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

    public function getProducts(): array
    {
        return (new Product())->find()->fetch(true);
    }

    public function getOrderDetails(): array
    {
        return (new OrderDetails())->find()->fetch(true);
    }

    public function getCustomers(): array
    {
        return (new Customer())->find()->fetch(true);
    }

    public function index(): void
    {
        $orders = $this->getOrder();
        $methodPayments = $this->getMethodPayments();
        $products = $this->getProducts();
        $customers = $this->getCustomers();

        $params = [
            "orders" => $orders,
            "methodPayments" => $methodPayments,
            "products" => $products,
            "customers" => $customers
        ];

        //Renderiza a página
        echo $this->view->render("vendas", $params);
    }

    public function createOrder(array $data): void
    {
        function getCustomerId(string $cpf)
        {
            $customer = (new Customer())->find("cpf = '{$cpf}'", "", "id")->fetch();
            $customer == null ? exit : $customer = $customer->data();

            //echo json_encode($customer, JSON_UNESCAPED_UNICODE);
            return $customer->id;
        }

        function getLastOrderId(): int
        {
            return (new Order())->find("", "", "id")
                ->order("id DESC")->limit(1)->fetch()->id;
        }

        function saveOrderDetails(array $orderProducts): void
        {
            function getProductValue(int $productId): float
            {
                return (new Product())->findById($productId)->preco;
            }

            function updateStorage(int $productId): void
            {
                $product = (new Product())->findById($productId);
                $product->quantidade = $product->quantidade - 1;
                $product->save();
            }

            foreach ($orderProducts as $orderProduct) {
                $orderId = getLastOrderId();

                $orderDetails = (new OrderDetails());

                $orderDetails->venda = $orderId;
                $orderDetails->produto = $orderProduct;
                $orderDetails->valor = getProductValue($orderProduct);

                updateStorage($orderProduct);

                if (!$orderDetails->save())
                    echo json_encode($orderDetails->fail()->getMessage(), JSON_UNESCAPED_UNICODE);
            }
        }

        $orderCpf = filter_var($data["cpf"], FILTER_SANITIZE_STRING);
        $orderPaymentMethod = filter_var($data["paymentMethod"], FILTER_SANITIZE_NUMBER_INT);
        $orderParcelasQuantity = filter_var($data["quantity"], FILTER_SANITIZE_NUMBER_INT);
        $orderProducts = $data["products"];

        $order = $this->model;
        $order->cliente = getCustomerId($orderCpf);
        $order->formapgto = $orderPaymentMethod;
        $order->numparcelas = $orderParcelasQuantity;

        if (!$order->save()) {
            echo json_encode($order->fail()->getMessage(), JSON_UNESCAPED_UNICODE);
            exit;
        }

        saveOrderDetails($orderProducts);
    }

    public function deleteOrder(array $data): void
    {
        function deleteOrderDetails(int $orderId): void
        {
            $orderDetails = (new OrderDetails())->find("venda = $orderId", "", "id")->fetch(true);

            if ($orderDetails != null) {
                foreach ($orderDetails as $orderDetail) {
                    $orderDetail->destroy();
                }
            }
        }

        $orderId = filter_var($data["id"], FILTER_SANITIZE_NUMBER_INT);

        deleteOrderDetails($orderId);

        $order = $this->model->findById($orderId);
        $order->destroy();
    }

    public function updateOrder(array $data): void
    {
        $orderId = filter_var($data["id"], FILTER_SANITIZE_NUMBER_INT);
        $orderCpf = filter_var($data["cpf"], FILTER_SANITIZE_STRING);
        $orderPaymentMethod = filter_var($data["paymentMethod"], FILTER_SANITIZE_NUMBER_INT);
        $orderParcelasQuantity = filter_var($data["quantity"], FILTER_SANITIZE_NUMBER_INT);

        $params = http_build_query(["cpf" => $orderCpf]);
        $customer = (new Customer())->find("cpf = :cpf", $params, "id");
        $customerId = $customer->fetch()->id;

        $order = (new Order())->findById($orderId);
        $order->cliente = $customerId;
        $order->formapgto = $orderPaymentMethod;
        $order->numparcelas = $orderParcelasQuantity;

        var_dump($order->data());

        if (!$order->save()) {
            echo json_encode($order->fail()->getMessage(), JSON_UNESCAPED_UNICODE);
            exit;
        }

        var_dump($order->data());

    }
}