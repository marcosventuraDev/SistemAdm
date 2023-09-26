<?php

namespace App\adms\Controllers;



class ViewUsers
{
   
    private array|string|null $data;

  
    public function index(): void
    {
        echo "Pagina visualizar usuario<br>";

        $this->data = [];

        $loadView = new \Core\ConfigView("adms/Views/users/viewUser", $this->data);
        $loadView->loadView();

    }
}