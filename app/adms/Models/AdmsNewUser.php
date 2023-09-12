<?php

namespace App\adms\Models;

use App\adms\Models\helper\AdmsConn;
use PDO;

class AdmsNewUser extends AdmsConn
{
    private array|null $data;
    private object $conn;
    private $resultDb;
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
        } else {
            $this->result = false;
        }
    }

}
