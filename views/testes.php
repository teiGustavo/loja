<?php

use Loja\Models\Customer;
use Loja\Models\Order;
use Loja\Models\OrderDetails;
use Loja\Models\Payment;
use Loja\Models\Product;

/* $details = new OrderDetails();
$detail = $details->findById(1);
//$detail->getOrder(); */

$products = new Product();
$product = $products->findById(1);

var_dump($products);
//$product->getCategory();
//
//$orders = new Order();
//$order = $orders->findById(1);
//$order->getPaymentMethod();
//
//$payments = new Payment();
//$payment = $payments->findById(1);
////$payment->getCategory();
//
$testes = ["0", "1"];
foreach ($testes as $teste) {
    echo $teste;
    echo "<br>";
}

var_dump($order = (new Order())->find("", "", "id")->order("id DESC")->limit(1)->fetch()->id);

$orderDetails = (new OrderDetails())->find("venda = 7", "", "id")->fetch(true);

/* $venda = 1;
$prod = 1;

$orderDetails->venda = $venda;
$orderDetails->produto = $prod;

$orderDetails->getProduct();

$orderDetails->valor = $orderDetails->product->preco; */

var_dump($orderDetails);


//var_dump($order->data());
//var_dump($payment->getTotalValue()->data());