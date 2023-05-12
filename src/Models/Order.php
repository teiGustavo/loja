<?php

namespace Loja\Models;

use CoffeeCode\DataLayer\DataLayer;

class Order extends DataLayer
{
    //Responsável por mapear a tabela "Formas_pagamentos" do BD
    public function __construct()
    {
        //Instancia o construtor da Classe pai (DataLayer)
        parent::__construct("orders", ["cliente", "formapgto"], "id", false);
    }

    public function getPayment(): Order
    {
        $this->payment = (new Payment())->findById($this->formapgto)->data();

        return $this;
    }

    public function getProduct(): Order
    {
        $orderDetails = (new OrderDetails())->find("venda = {$this->id}", "", "id")->fetch()->id;

        $this->product = (new Product())->findById($orderDetails)->data();

        return $this;
    }

 /*    public function getPaymentMethod(): Order
    {
        $payment = ((new Payment())->findById($this->formapgto)->data());
        
        $this->methodPayment = $payment->descricao;
        $this->methodPaymentTimesUsed = $payment->timesUsed;
        $this->methodPaymentTotalValue = $payment->totalValue; 

       return $this;
    }  */

    public function getCustomer(): Order
    {
        $this->customer = (new Customer())->findById(intval($this->cliente))->data();

        return $this;
    }
}