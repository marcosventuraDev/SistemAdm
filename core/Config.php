<?php

namespace core;
abstract class Config
{
    protected function configAdm()
    {
        define('URL','http://localhost/Estudo/2023/Setembro/SistemAdm/' );
        define('URLADM','http://localhost/Estudo/2023/Setembro/SistemAdm/' );

        define('CONTROLLER', 'Login');
        define('METODO', 'index');
        define('CONTROLLERERRO', 'Login');

        define('HOST', 'localhost');
        define('USER', 'root');
        define('PASS', '');
        define('DBNAME', 'sitephp_mvc');
        define('PORT', '3306');
        


        define('ADM', 'marcosventura.dev@gmail.com');
        

    }
}