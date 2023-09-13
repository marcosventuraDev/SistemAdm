<?php

namespace App\adms\Models;

class AdmsNewUser 
{
    private array|null $data;

    private $result;

    function getResult()
    {
        return $this->result;
    }
    public function create(array $data = null)
    {
        $this->data = $data;
      
        $valEmptField = new \App\adms\Models\helper\AdmsValEmptyField();
        $valEmptField->valField($this->data);

        if ($valEmptField->getResult()) {

            $this->valImput();
        } else {
            $this->result = false;
        }
    }

    private function valImput():void
    {
        $valEmail = new \App\adms\Models\helper\AdmsValEmail();
        $valEmail->validateEmail($this->data['email']);

        $valEmailSingle = new \App\adms\Models\helper\AdmsValEmailSingle();
        $valEmailSingle->validateEmailSingle($this->data['email']);

        $valPassword = new \App\adms\Models\helper\AdmsValPassword();
        $valPassword->validatePassword($this->data['password']);

         if(($valEmail->getResult())and ($valEmailSingle->getResult()) and ($valPassword->getResult())){
            $this->add();
         }else{
            $this->result = false;
         }
    }

    private function add(): void
    {
        $this->data['password'] = password_hash($this->data['password'], PASSWORD_DEFAULT);
            $this->data['user'] = $this->data['email'];
            $this->data['created'] = date("Y-m-d H:i:s");

         

            $createUser = new \App\adms\Models\helper\AdmsCreate;
            $createUser->exeCreate("adms_users", $this->data);
            
            if($createUser->getResult()){
                $_SESSION['msg']="<p style='color: green;'>Usuário cadastrado com sucesso</p>";
                $this->result = true;
            }else{
                $_SESSION['msg']="<p style='color: red;'>Usuário não cadastrado com sucesso</p>";
                $this->result = false;
            }
           
            $this->result = false;
    }

}
