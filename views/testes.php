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


//var_dump($order->data());
//var_dump($payment->getTotalValue()->data());