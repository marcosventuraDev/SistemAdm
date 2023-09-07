<?php
namespace App\adms\Controllers;
class Login
{
    private array|null|string $data;
    public function index():void
    {
        $this->data = [];

        $loadView = new \Core\ConfigView("adms/Views/login/login", $this->data);
        $loadView->loadView();
    }
}