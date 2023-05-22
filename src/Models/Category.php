<?php

namespace Loja\Models;
use CoffeeCode\DataLayer\DataLayer;

class Category extends DataLayer
{
     //Responsável por mapear a tabela "Categorias" do BD
     public function __construct() 
     {
         //Instancia o construtor da Classe pai (DataLayer)
         parent::__construct("categorias", ["nome"], "codigo_categoria", false);
     }

     public function getProduct(): Category
     {
         $products = (new Product())->find("categoria = {$this->codigo_categoria}");
         $this->qtdProducts = $products->count();
         $this->products = $products->fetch();

         return $this;
     }
}