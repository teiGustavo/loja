<?php

namespace Loja\Models;
use CoffeeCode\DataLayer\DataLayer;

class Category extends DataLayer
{
     //Responsável por mapear a tabela "Produtos" do BD
     public function __construct() 
     {
         //Instancia o construtor da Classe pai (DataLayer)
         parent::__construct("categorias", ["nome"], "codigo_categoria", true);
     }
}