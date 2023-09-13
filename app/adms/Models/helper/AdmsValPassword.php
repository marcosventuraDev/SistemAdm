<?php

namespace App\adms\Models\helper;


class AdmsValPassword
{
    private string $password;
    private bool $result;

    public function getResult(): bool
    {
        return $this->result;
    }

    public function validatePassword(string $password): void
    {
        $this->password = $password;

        if (stristr($this->password, "'")) {
            $_SESSION['msg'] = "<p style = 'color:red'>Erro: Caracter ( ' ) utilizado na senha inválido</p>";
            $this->result = false;
        } else {
            if (stristr($this->password, " ")) {
                $_SESSION['msg'] = "<p style = 'color:red'>Erro:Proibido usar espaço em branco no campo senha!</p>";
                $this->result = false;
            } else {
                $this->valExtensPassword();
            }
        }
    }

    private function valExtensPassword()
    {
        if(strlen($this->password)<6){
            $_SESSION['msg'] =  "<p style='color:red'>Erro: A senha deve ter no mínimo 6 caracteres</p>";
            $this->result = false;
        }else{
            $this->valValuePassword();
        }
    }

    private function valValuePassword(): void
    {
        if(preg_match('/^(?=.*[0-9])(?=.*[a-zA-Z])[a-zA-Z0-9-@#$%*;]{6,}$/', $this->password)){
            $this->result = true;
        }else{
            $_SESSION['msg'] =  "<p style='color:red'>Erro: A senha deve ter letras e números</p>";
            $this->result = false;

        }
    }
}
