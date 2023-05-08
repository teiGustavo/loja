<?php

namespace Loja\Models;

use CoffeeCode\DataLayer\DataLayer;

class OrderDetails extends DataLayer
{
    //Responsável por mapear a tabela "Categorias" do BD
    public function __construct()
    {
        //Instancia o construtor da Classe pai (DataLayer)
        parent::__construct("order_details", ["venda", "produto", "valor"], "id", false);
    }

    public function getProduct(): OrderDetails
    {
        $this->product = (new Product())->findById($this->produto)->data();
        
        return $this;
    }

    public function getOrder(): OrderDetails
    {
        $this->order = (new Order())->findById($this->venda)->data();
        
        return $this;
    }
}