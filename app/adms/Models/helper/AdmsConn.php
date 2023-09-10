<?php

namespace App\adms\Models\helper;

use PDOException;
use PDO;

abstract class AdmsConn
{
    private string $host = HOST;
    private string $user = USER;
    private string $pass = PASS;
    private string $dbname = DBNAME;
    private string|int $port = PORT;
    private object $connect;


    protected function connectDb(): object
    {

        try {
           $this->connect = new PDO("mysql:host={$this->host};port={$this->port};dbname=" . $this->dbname, $this->user, $this->pass);

           return $this->connect;
        } catch (PDOException $err) {
            die("<p style='color:red'>ERRO: Por favor tente novamente. Caso o erro persista, entre em contato com o administrador <a href='#'>" . ADM . "</a></p>");
        }
    }
}
