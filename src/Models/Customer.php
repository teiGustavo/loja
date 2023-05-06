<?php

namespace Loja\Models;
use CoffeeCode\DataLayer\DataLayer;

class Customer extends DataLayer
{
     //Responsável por mapear a tabela "Clientes" do BD
     public function __construct() 
     {
         //Instancia o construtor da Classe pai (DataLayer)
         parent::__construct("clientes", ["nome", "email", "usuario", "senha", "datanasc"], "cpf", false);
     }
}