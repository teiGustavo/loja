<?php

namespace Loja\Controllers;

use Loja\Models\Customer;
use Hackzilla\PasswordGenerator\Generator\ComputerPasswordGenerator;
use Uptodown\RandomUsernameGenerator\Generator;

class CustomerController extends MainController
{
    protected $model;

    public function __construct($router)
    {
        parent::__construct($router);

        $modelCustomer = new Customer();
        $this->model = $modelCustomer;
    }

    public function getCustomers(): array
    {
        $customers = $this
            ->model
            ->find(
                "",
                "",
                "id, cpf, 
                    nome, date_format(datanasc, '%d/%m/%Y') as datanasc, date_format(datacadastro, '%d/%m/%Y') as datacadastro, email"
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
            $username = substr($username, 0, 30);

            return $username;
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

            $password = $generator->generatePassword();

            return $password;
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

        $customer->find("", "", "
            cpf, 
            nome,
            email,
            datacadastro
        ");

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

    public function update(array $data): void
    {
        $customerId = filter_var($data["id"], FILTER_SANITIZE_NUMBER_INT);
        $customerCpf = filter_var($data["cpf"], FILTER_SANITIZE_STRING);
        $customerName = filter_var($data["name"], FILTER_SANITIZE_STRING);
        $customerEmail = filter_var($data["email"], FILTER_SANITIZE_EMAIL);
        $customerDateBirth = filter_var($data["dateBirth"], FILTER_SANITIZE_STRING);

        $customer = $this->model->findById($customerId);
        $customer->cpf = $customerCpf;
        $customer->nome = $customerName;
        $customer->email = $customerEmail;
        $customer->datanasc = $customerDateBirth;
        $customer->save();
    }
}