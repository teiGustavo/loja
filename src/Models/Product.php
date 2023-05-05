<?php

namespace Loja\Models;
use CoffeeCode\DataLayer\DataLayer;

class Product extends DataLayer
{
     //Responsável por mapear a tabela "Produtos" do BD
     public function __construct() 
     {
         //Instancia o construtor da Classe pai (DataLayer)
         parent::__construct("produtos", ["nome", "preco", "quantidade"], "codigo_produto", true);
     }
}