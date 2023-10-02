<?php

namespace App\adms\Controllers;

class NewConfEmail
{



    private array|string|null $data = [];
    private array|null $dataForm;

    public function index():void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
     
        if(!empty($this->dataForm['SendNewConfEmail'])){
            unset($this->dataForm['SendNewConfEmail']);
            $newConfEmail = new \App\adms\Models\AdmsNewConfEmail();
            $newConfEmail->newConfEmail($this->dataForm);
            if($newConfEmail->getResult()){
                $urlRedirect = URLADM . "login/index";
                header("Location: $urlRedirect");
            }else{
                $this->data['form'] = $this->dataForm;
                $this->viewNewConfEmail();
            }

        }else{

            $this->viewNewConfEmail();
        }
    }

    private function viewNewConfEmail(): void
    {
       $loadView = new \Core\ConfigView("adms/Views/login/newConfEmail", $this->data);
       $loadView->loadView();
    }
  
}