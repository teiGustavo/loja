<?php

namespace Loja\Models;

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
        $payment = (
            $this
                ->otherFind(
                    "CONCAT('R$ ', REPLACE(REPLACE(REPLACE(FORMAT(SUM(OD.valor), 2),'.',';'),',','.'),';',',')) as total", 
                    "formas_pagamentos AS FP JOIN orders AS O ON FP.codigo = O.formapgto JOIN order_details AS OD ON O.id = OD.id", 
                    "FP.codigo = $this->codigo"
                )
                ->fetch()
                ->data()
                ->total
        );

        $this->totalValue = $payment;

        return $this;
    }
}