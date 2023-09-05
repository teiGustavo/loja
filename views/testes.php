<?php

use Loja\Models\Customer;
use Loja\Models\Order;
use Loja\Models\OrderDetails;
use Loja\Models\Payment;
use Loja\Models\Product;
use Loja\Models\User;

$params = http_build_query(["cpf" => "640.817.674-75"]);
$customer = (new Customer())->find("cpf = :cpf", $params, "id");
var_dump($customer, $customer->fetch());
