<?php

//Conexão com o Banco de Dados
const DATA_LAYER_CONFIG = [
    "driver" => "mysql",
    "host" => "localhost",
    "port" => "3306",
    "dbname" => "loja",
    "username" => "root",
    "passwd" => "root",
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
];

//Constante de URL base do site
const URL_BASE = "http://localhost/GustavoT/loja";

//Constante de Título base do site
const TITLE_PREFIX = "Shop Gestor";

function url(string $path): string
{
    if ($path) {
        return URL_BASE . "{$path}";
    }
    return URL_BASE;
}