<?php

namespace Loja\Controllers;
use Loja\Models\Customer;

class CustomerController extends MainController
{
    public function getCustomers()
    {
        $model = new Customer();
        $customers = $model->find("", "", "CONCAT(SUBSTR(cpf,1,3),'.',SUBSTR(cpf,4,3),'.',SUBSTR(cpf,7,3),'-',SUBSTR(cpf,10,2)) as cpf, nome, date_format(datanasc, '%d/%m/%Y') as datanasc, date_format(datacadastro, '%d/%m/%Y') as datacadastro")->fetch(true);

        return $customers;
    }

    public function index()
    {
        $customers = $this->getCustomers();

        $params = [
            "customers" => $customers
        ];

        //Renderiza a página
        echo $this->view->render("clientes", $params);
    }
}