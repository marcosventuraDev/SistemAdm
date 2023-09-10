<?php
namespace App\adms\Controllers;
class Dashboard
{
        private array|string|null $data;
    public function index():void
    {
        $this->data= "Bem Vindo, ";

        $loadView = new \Core\ConfigView("adms/Views/dashboard/dashboard", $this->data);
        $loadView->loadView();
    }
}