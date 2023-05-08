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

    public function getPaymentMethod()
    {
        $this->paymentMethod = (new Payment())->findById($this->formapgto)->data();

        return $this;
    }

    public function getPayment(): Order
    {
        $payment = ((new Payment())->findById($this->id)->getTimesUsed()->getTotalValue()->data());
        
        $this->methodPayment = $payment->descricao;
        $this->methodPaymentTimesUsed = $payment->timesUsed;
        $this->methodPaymentTotalValue = $payment->totalValue;

        return $this;
    }
}