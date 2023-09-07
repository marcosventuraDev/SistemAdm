<?php

namespace core;
class ConfigView
{
   
    public function __construct(private string $nameView, private array|null $data)
    {

    }

    public function loadView():void
    {
        if(file_exists("app/{$this->nameView}.php")){
            include "app/{$this->nameView}.php";
        }else{
           die("<p style='color:red'>ERRO: Por favor tente novamente. Caso o erro persista, entre em contato com o administrador <a href='#'>".ADM ."</a></p>");
        }
     
       
    }
}