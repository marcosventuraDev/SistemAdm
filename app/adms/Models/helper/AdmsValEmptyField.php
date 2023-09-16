<?php

namespace App\adms\Models\helper;


class AdmsValEmptyField
{
    
    private array|null $data;

    
    private bool $result;

    
    function getResult(): bool
    {
        return $this->result;
    }

    public function valField(array $data = null): void
    {
        $this->data = $data;
        $this->data = array_map('strip_tags', $this->data);
        $this->data = array_map('trim', $this->data);

        if(in_array('', $this->data)){
            $_SESSION['msg'] = "<p style='color: #f00'>Erro: Necessário preencher todos os campos!</p>";
            $this->result = false;
        }else{
            $this->result = true;
        }
    }
}
