<?php

namespace App\adms\Models\helper;

//Classe que faz a validação do password
class AdmsValPassword
{
    private string $password;
    private bool $result;

    public function getResult(): bool
    {
        return $this->result;
    }

    //função para validar a senha que retorna void
    public function validatePassword(string $password): void
    {
        //a variável recebe o valor recebido por parametro da função
        $this->password = $password;
        
        //se o valor recebido conter ' a session[msg] recebe uma msg
        if (stristr($this->password, "'")) {
            $_SESSION['msg'] = "<p style = 'color:red'>Erro: Caracter ( ' ) utilizado na senha inválido</p>";

            $this->result = false;
        } else {
            //se no valor recebido contiver espaço em branco a msg de aleta tbm será atrimuído à session
            if (stristr($this->password, " ")) {
                $_SESSION['msg'] = "<p style = 'color:red'>Erro:Proibido usar espaço em branco no campo senha!</p>";
                $this->result = false;
            } else {
                $this->valExtensPassword();
            }
        }
    }

    // cunção que determina o valor mínimo de caracteres
    private function valExtensPassword()
    {
        if(strlen($this->password)<6){
            $_SESSION['msg'] =  "<p style='color:red'>Erro: A senha deve ter no mínimo 6 caracteres</p>";
            $this->result = false;
        }else{
            $this->valValuePassword();
        }
    }

    //função que verifica a existencia ou não de caractéres permitidos
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
