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

    private int|string $port = PORT;

    private object $connect;






    protected function connectDb(): object
    {
        try {

            $this->connect = new PDO("mysql:host={$this->host};dbname=" . $this->dbname, $this->user, $this->pass);

            return $this->connect;
        } catch (PDOException $err) {
            die("Erro - 001: Por favor tente novamente. Caso o problema persista, entre em contato o administrador " . EMAILADM);
        }
    }
}
