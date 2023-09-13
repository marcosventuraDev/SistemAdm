<?php

namespace App\adms\Models\helper;

use App\adms\Models\helper\AdmsConn;

class AdmsValEmptyField
{
    private array|null $data;
    private bool $result;

    function getResult(){
        return $this->result;
    }

    public function valField(array $data = null)
    {
       $this->data = $data;
       $this->data= array_map('strip_tags', $this->data);
       $this->data = array_map('trim', $this->data);


       if(in_array('', $this->data)){
        $_SESSION['msg'] = "<p style='color:red'>Erro: Precisa preencher todos os campos</p>";
        $this->result = false;
       }else{
        $this->result = true;
       }
    
    }
    
  
}
