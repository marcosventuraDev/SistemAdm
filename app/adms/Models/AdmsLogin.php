<?php

namespace App\adms\Models;


class AdmsLogin
{
    private array|null $data;
    private array|null $resultDb;
    private bool $result;

    function getResult(): bool
    {
        return $this->result;
    }

    public function login(array $data = null): void
    {
        $this->data = $data;

        $viewUser = new \App\adms\Models\helper\AdmsRead();
        $viewUser->fullRead("SELECT id, name, nickname, email, password, image FROM adms_users WHERE user =:user OR email =:email LIMIT :limit", "user={$this->data['user']}&email={$this->data['user']}&limit=1");
       
        $this->resultDb = $viewUser->getResult();
        if($this->resultDb){
            $this->valPassword();
        }else{
            $_SESSION['msg']="<p style='color:red'><b>Erro:</b> Usuário ou senha não encontrado</p>";
            $this->result = false;
        }
    }
    
    private function valPassword(): void
    {
        if(password_verify($this->data['password'], $this->resultDb[0]['password'])){
            $_SESSION['user_id']= $this->resultDb[0]['id'];
            $_SESSION['user_name']= $this->resultDb[0]['name'];
            $_SESSION['user_nickname']= $this->resultDb[0]['nickname'];
            $_SESSION['user_email']= $this->resultDb[0]['email'];
            $_SESSION['user_image']= $this->resultDb[0]['image'];
            $this->result = true;
        }else{
            $_SESSION['msg']="<p style='color:red'><b>Erro:</b> Usuário ou senha não encontrado</p>";
            $this->result = false;
        }
    } 
}
