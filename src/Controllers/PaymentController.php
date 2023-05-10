<?php

namespace Loja\Controllers;

use Loja\Models\Payment;
use Loja\Models\Order;

class PaymentController extends MainController
{
    protected $model;

    public function __construct($router, $model = new Payment())
    {
        parent::__construct($router);

        $this->model = $model;
    }

    public function getOrders(): array
    {
        $model = new Order();
        $orders = $model->find()->fetch(true);

        return $orders != null ? $orders : [];
    }

    public function getPaymentsValue(): array
    {
        $paymentValues = $this->model->find()->fetch(true);

        return $paymentValues != null ? $paymentValues : [];
    }

    public function index(): void
    {
        $payments = $this->model->find()->fetch(true);

        $params = [
            "payments" => $payments,
            "paymentValues" => $this->getPaymentsValue()
        ];

        //Renderiza a página
        echo $this->view->render("formas_pagamentos", $params);
    }

    public function createPayment(array $data): void
    {

        $paymentDesc = filter_var($data["desc"], FILTER_SANITIZE_STRING);

        $payment = $this->model;
        $payment->descricao = $paymentDesc;

        if (!$payment->save())
            echo json_encode($payment->fail()->getMessage(), JSON_UNESCAPED_UNICODE);
    }

    public function deletePayment(array $data): void
    {
        $paymentId = filter_var($data["id"], FILTER_SANITIZE_NUMBER_INT);

        $payment = $this->model->findById($paymentId);
        $payment->destroy();
    }

    public function updatePayment(array $data): void
    {
        $paymentId = filter_var($data["id"], FILTER_SANITIZE_NUMBER_INT);
        $paymentDesc = filter_var($data["desc"], FILTER_SANITIZE_STRING);

        $payment = $this->model->findById($paymentId);
        $payment->descricao = $paymentDesc;
        $payment->save();
    }
}