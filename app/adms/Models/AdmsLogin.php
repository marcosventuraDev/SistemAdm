<?php

namespace App\adms\Models;

use App\adms\Models\helper\AdmsConn;
use PDO;
class AdmsLogin extends AdmsConn
{
    private array|null $data;
    private object $conn;
    private $resultDb;
    private $result;

    function getResult(){
        return $this->result;
    }

    public function login(array $data = null)
    {
        $this->data = $data;
        $this->conn = $this->connectDb();

        $query_val_login = "SELECT id, name, nickname, email, password, image 
        FROM adms_users
        WHERE user = :user
        LIMIT 1";

        $result_val_login = $this->conn->prepare($query_val_login);
        $result_val_login->bindParam(':user', $this->data['user'], PDO::PARAM_STR);
        $result_val_login->execute();

        $this->resultDb = $result_val_login->fetch();
       
        if($this->resultDb){
         
            $this->valPassword();
            $_SESSION['user_id']= $this->resultDb['id'];
            $_SESSION['user_name']= $this->resultDb['name'];
            $_SESSION['user_nickname']= $this->resultDb['nickname'];
            $_SESSION['user_email']= $this->resultDb['email'];
            $_SESSION['user_image']= $this->resultDb['image'];
        }else{
    
            $_SESSION['msg']="<p style='color:red'><b>Erro:</b> Usuário ou senha não encontrado</p>";
            $this->result = false;
           
        }
    
    }
    
    private function valPassword()
    {
        if(password_verify($this->data['password'], $this->resultDb['password'])){
            $this->result = true;
        }
    
    }
}
