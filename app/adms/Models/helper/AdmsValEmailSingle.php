<?php

namespace App\adms\Models\helper;


class AdmsValEmailSingle
{
    
    private string $email;

    
    private bool|null $edit;

  
    private int|null $id;

    
    private array|null $resultBd;

  
    private bool $result;

   
    function getResult(): bool
    {
        return $this->result;
    }

   
    public function validateEmailSingle(string $email, bool|null $edit = null, int|null $id = null): void
    {
        $this->email = $email;
        $this->edit = $edit;
        $this->id = $id;

        $valEmailSingle = new \App\adms\Models\helper\AdmsRead();
        if(($this->edit == true) and (!empty($this->id))){
            $valEmailSingle->fullRead("SELECT id FROM adms_users WHERE email =:email id <>:id LIMIT :limit", "email={$this->email}&id={$this->id}&limit=1");
        }else{
            $valEmailSingle->fullRead("SELECT id FROM adms_users WHERE email =:email LIMIT :limit", "email={$this->email}&limit=1");
        }

        $this->resultBd = $valEmailSingle->getResult();
        if(!$this->resultBd){
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Este e-mail já está cadastrado!</p>";
            $this->result = false;
        }
    }
}
