<?php
namespace App\adms\Controllers;
class ViewUsers
{
    private array|null|string $data;
    public function index(): void
    {
        $this->data = null;

       $loadView = new \Core\ConfigView("adms/Views/users/viewUser", $this->data);
       $loadView->loadView();
      
    }
}