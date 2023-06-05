<?php

namespace Loja\Controllers;

use Loja\Models\Customer;
use Hackzilla\PasswordGenerator\Generator\ComputerPasswordGenerator;
use Uptodown\RandomUsernameGenerator\Generator;

class CustomerController extends MainController
{
    public function __construct(
        $router,
        protected Customer $model = new Customer()
    ) {
        parent::__construct($router);
    }

    public function getCustomers(): array
    {
        $customers = $this
            ->model
            ->find(
                columns: "id, cpf, 
                    nome, date_format(datanasc, '%d/%m/%Y') as datanasc, 
                    date_format(datacadastro, '%d/%m/%Y') as datacadastro, email"
            )
            ->fetch(true)
        ;

        return $customers != null ? $customers : [];
    }

    public function index(): void
    {
        $customers = $this->getCustomers();

        $params = [
            "customers" => $customers
        ];

        //Renderiza a página
        echo $this->view->render("customers", $params);
    }

    public function create(array $data): void
    {
        function generateUsername(): string
        {
            $generator = new Generator();
            $username = $generator->makeNew();

            return substr($username, 0, 30);
        }

        function generatePassword(): string
        {
            $generator = new ComputerPasswordGenerator();

            $generator
                ->setOptionValue(ComputerPasswordGenerator::OPTION_UPPER_CASE, true)
                ->setOptionValue(ComputerPasswordGenerator::OPTION_LOWER_CASE, true)
                ->setOptionValue(ComputerPasswordGenerator::OPTION_NUMBERS, true)
                ->setOptionValue(ComputerPasswordGenerator::OPTION_SYMBOLS, false)
            ;

            return $generator->generatePassword();
        }

        $data = filter_var_array($data, FILTER_SANITIZE_STRING);

        if (in_array("", $data)) {
            $callback["message"] = "Por favor, informe todos os campos!";
            echo json_encode($callback);

            return;
        }

        $customer = $this->model;
        $customer->cpf = $data["cpf"];
        $customer->nome = $data["name"];
        $customer->email = $data["email"];
        $customer->usuario = generateUsername();
        $customer->senha = generatePassword();
        $customer->datanasc = $data["datanasc"];
        $customer->save();

        $customer = (new Customer())
            ->find(columns: "
                id,
                cpf, 
                nome,
                email,
                date_format(datacadastro, '%d/%m/%Y') as datacadastro
            ")
            ->order("id DESC")
            ->limit(1)
            ->fetch();

        $callback["message"] = "";
        $callback["customer"] = $this->view->render("fragments/customer", ["customer" => $customer]);

        echo json_encode($callback);
    }

    public function delete(array $data): void
    {
        $customerId = filter_var($data["id"], FILTER_SANITIZE_NUMBER_INT);

        $customer = $this->model->findById($customerId);
        $customer->destroy();
    }

    public function find(array $data): void
    {
        if (empty($data["id"])) {
            return;
        }

        $id = filter_var($data["id"], FILTER_VALIDATE_INT);

        $customer = (new Customer())->findById($id);

        $callback["customer"] = $customer->data();

        echo json_encode($callback);
    }

    public function update(array $data): void
    {
        if (empty($data["id"])) {
            return;
        }

        $id = filter_var($data["id"], FILTER_VALIDATE_INT);
        $data = filter_var_array($data, FILTER_SANITIZE_STRING);

        if (in_array("", $data)) {
            $callback["message"] = "Por favor, informe todos os campos!";
            echo json_encode($callback);

            return;
        }

        $customer = (new Customer())->findById($id);
        $customer->cpf = $data["cpf"];
        $customer->nome = $data["name"];
        $customer->email = $data["email"];
        $customer->datanasc = $data["datanasc"];
        $customer->save();

        $customer = (new Customer())
            ->findById($id, "
                id, 
                cpf, 
                nome, 
                email, 
                date_format(datacadastro, '%d/%m/%Y') as datacadastro"
            );

        $callback["message"] = "";
        $callback["customer"] = $this->view->render("fragments/customer", ["customer" => $customer]);

        echo json_encode($callback);
    }
}