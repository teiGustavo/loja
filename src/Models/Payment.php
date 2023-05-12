<?php

namespace Loja\Models;

use CoffeeCode\DataLayer\Connect;
use CoffeeCode\DataLayer\DataLayer;

class Payment extends DataLayer
{
    //Responsável por mapear a tabela "Formas_pagamentos" do BD
    public function __construct()
    {
        //Instancia o construtor da Classe pai (DataLayer)
        parent::__construct("formas_pagamentos", ["descricao"], "codigo", false);
    }

    public function getTimesUsed(): Payment
    {
        $this->timesUsed = ((new Order())->find("formapgto = $this->codigo", "", "count(formapgto) as quantity")->fetch()->data())->quantity;

        return $this; 
    }

    public function getTotalValue(): Payment
    {
        $connect = Connect::getInstance();
        $error = Connect::getError();

        if ($error) {
            echo json_encode($error->getMessage());
            exit;
        }

        $payment = $connect
            ->query(
                "SELECT FP.descricao, CONCAT('R$ ', REPLACE(REPLACE(REPLACE(FORMAT(SUM(OD.valor), 2),'.',';'),',','.'),';',',')) AS valor
                    FROM orders AS O JOIN order_details AS OD ON O.id = OD.venda JOIN formas_pagamentos AS FP ON O.formapgto = FP.codigo
                    WHERE FP.codigo = {$this->codigo}"
            )
            ->fetch()
            ->valor
        ;

        $this->totalValue = $payment;

        return $this;
    }
}