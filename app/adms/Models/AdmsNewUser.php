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

    function getResult(){
        return $this->result;
    }

    public function create(array $data = null)
    {
        $this->data = $data;

        $valEmptField = new \App\adms\Models\helper\AdmsValEmptyField();
        $valEmptField->valField($this->data);

        if($valEmptField->getResult()){
            $this->conn = $this->connectDb();
    
            $this->data['password'] = password_hash($this->data['password'], PASSWORD_DEFAULT);
    
            $query_new_user = "INSERT INTO adms_users (name, email, user, password, created) VALUES (:name, :email, :user, :password, NOW()) ";
            $add_new_user = $this->conn->prepare($query_new_user);
            $add_new_user->bindParam(":name", $this->data['name'], PDO::PARAM_STR);
            $add_new_user->bindParam(":email", $this->data['email'], PDO::PARAM_STR);
            $add_new_user->bindParam(":user", $this->data['email'], PDO::PARAM_STR);
            $add_new_user->bindParam(":password", $this->data['password'], PDO::PARAM_STR);
    
            $add_new_user->execute();
    
            if($add_new_user->rowCount()){
                $_SESSION['msg']="<p style='color: green;'>Usuário cadastrado com sucesso</p>";
                $this->result = true;
            }else{
                $_SESSION['msg']="<p style='color: red;'>Usuário não cadastrado com sucesso</p>";
                $this->result = false;
            }
        
        }else{
            $this->result = false;
        }

    }

    
  
}
