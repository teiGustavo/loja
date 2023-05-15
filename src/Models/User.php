<?php

namespace Loja\Models;
use CoffeeCode\DataLayer\DataLayer;

class User extends DataLayer
{
     //Responsável por mapear a tabela "Categorias" do BD
     public function __construct() 
     {
         //Instancia o construtor da Classe pai (DataLayer)
         parent::__construct("usuarios", ["nome_completo", "username", "senha", "email"], "codigo_usuario", false);
     }
}