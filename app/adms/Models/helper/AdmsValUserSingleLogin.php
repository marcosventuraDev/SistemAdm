<?php

namespace App\adms\Models\helper;


class AdmsValUserSingleLogin
{
    private string $user;
    private bool|null $edit;
    private int|null $id;
    private bool $result;
    private $resultDb;

    public function getResult(): bool
    {
        return $this->result;
    }

    public function validateUserSingleLogin(string $user, bool|null $edit = null, int|null $id = null): void
    {
        $this->user = $user;
        $this->edit = $edit;
        $this->id = $id;

        $valEmailSingle = new \App\adms\Models\helper\AdmsRead();
        if(($this->edit == true) and (!empty($this->id))){
            $valEmailSingle->fullRead("SELECT id FROM adms_users WHERE email =:email id <>:id LIMIT :limit", "email={$this->user}&id={$this->id}&limit=1");
        }else{
            $valEmailSingle->fullRead("SELECT id FROM adms_users WHERE user =:user LIMIT :limit", "user={$this->user}&limit=1");
        }

        $this->resultDb = $valEmailSingle->getResult();
        if(!$this->resultDb){
            $this->result = true;
        }else{
            $_SESSION['msg']= "<p style= 'color:red'>Erro: Este usupario já está cadastrado!";
            $this->result= false;
        }

     
    }
    
    
  
}
