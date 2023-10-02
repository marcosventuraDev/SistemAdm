<?php

namespace App\adms\Controllers;

class ConfEmail
{

   
    private string|null $key;

    public function index():void
    {
        $this->key = filter_input(INPUT_GET, "key", FILTER_DEFAULT );
   echo "Chave: {$this->key}<br>";

        if(!empty($this->key)){
            $this->valKey();
        }else{
            $_SESSION['msg'] = "<p style='color: red;'>Erro: Link Invalido!</p>";
            $urlRedirect = URLADM . "login/index";
                header("Location: $urlRedirect");
        }
    }

    private function valKey():void
    {
        $confEmail = new \App\adms\Models\AdmsConfEmail();
        $confEmail->confEmail($this->key);

        if($confEmail->getResult()){
            $urlRedirect = URLADM . "login/index";
                header("Location: $urlRedirect");
        }else{
            $urlRedirect = URLADM . "login/index";
                header("Location: $urlRedirect");
        }
    }
}