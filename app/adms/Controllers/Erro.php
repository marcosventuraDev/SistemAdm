<?php

namespace App\adms\Controllers;

class Erro
{

   
    private array|string|null $data;

    public function index():void
    {

        $this->data = "<p style='color: #f00;'>Página não encontrada!</p>";

        $loadView = new \Core\ConfigView("adms/Views/erro/erro", $this->data);
        $loadView->loadView();
    }
}