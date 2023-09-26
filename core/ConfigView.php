<?php

namespace Core;


class ConfigView
{
    
  
    public function __construct(private string $nameView, private array|string|null $data)
    {
    }


    public function loadView():void
    {
        if(file_exists('app/' .$this->nameView . '.php')){
            include 'app/adms/Views/include/head.php';
            include 'app/' .$this->nameView . '.php';
            include 'app/adms/Views/include/footer.php';
        }else{
            die("Erro - 002: Por favor tente novamente. Caso o problema persista, entre em contato o administrador " . EMAILADM);
        }
    }
}
