<?php

namespace App\adms\Models;
use App\adms\Models\helper\AdmsConn;
use PDO;


class AdmsConfEmail extends AdmsConn
{


    private string $key;
    private bool $result;
    private array $resultBd;
    function getResult(): bool
    {
        return $this->result;
    }

    public function confEmail(string $key): void
    {
        $this->key = $key;

        if (!empty($this->key)) {
            $viewKeyConfEmail = new \App\adms\Models\helper\AdmsRead();
            $viewKeyConfEmail->fullRead("SELECT id FROM adms_users WHERE conf_email = :conf_email LIMIT :limit", "conf_email={$this->key}&limit=1");
            $this->resultBd = $viewKeyConfEmail->getResult();
            if ($this->resultBd) {
                $this->updateSitUser();
            } else {
                $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Link Invalido!</p>";
                $this->result = false;
                echo "<p style='color: #f00;'>Erro: Link Invalido!</p>";
            }
        } else {
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Link Invalido!</p>";
            $this->result = false;
        }
    }

    private function updateSitUser(): void
    {
        $conf_email = null;
        $adms_sits_user_id = 1;

        $query_activate_user = "UPDATE adms_users
                            SET conf_email= :conf_email, adms_sits_user_id = :adms_sits_user_id, modified = NOW() 
                            where  id=:id LIMIT 1";

                            $activate_email = $this->connectDb()->prepare($query_activate_user);
                            $activate_email->bindParam(':conf_email', $conf_email);
                            $activate_email->bindParam(':adms_sits_user_id', $adms_sits_user_id);
                            $activate_email->bindParam(':id', $this->resultBd[0]['id']);
                            $activate_email->execute();

                            if($activate_email->rowCount()){
                                $_SESSION['msg'] = "<p style='color: green;'>Success: Email Ativado com sucesso!</p>";
                                $this->result = true;
                            }else{
                                $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Link Invalido!</p>";
                                $this->result = false;
                            }

    }
}
