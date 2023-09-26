<?php

namespace App\adms\Controllers;


class NewUser
{

       private array|string|null $data = [];

    private array|null $dataForm;

  
    public function index(): void
    {

        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);        

        if(!empty($this->dataForm['SendNewUser'])){
            //var_dump($this->dataForm);
            unset($this->dataForm['SendNewUser']);
            $createNewUser = new \App\adms\Models\AdmsNewUser();
            $createNewUser->create($this->dataForm);
            if($createNewUser->getResult()){
                $urlRedirect = URLADM;
                header("Location: $urlRedirect");
            }else{
                $this->data['form'] = $this->dataForm;
                $this->viewNewUser();
            }           
        }else{
            $this->viewNewUser();
        }        
    }

    
    private function viewNewUser(): void
    {
        $loadView = new \Core\ConfigView("adms/Views/login/newUser", $this->data);
        $loadView->loadView();
    }
}
