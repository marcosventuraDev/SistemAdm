<?php

namespace App\adms\Models;

use App\adms\Models\helper\AdmsConn;
use PDO;


class AdmsNewConfEmail extends AdmsConn
{

    private array|null $data;
    
    private string $fromEmail;
    private bool $result;
    private string $url;
    private array $resultBd;
    private string $firstName;
    private array $emailData;
    function getResult(): bool
    {
        return $this->result;
    }

    public function newConfEmail(array|null $data = null): void
    {
        $this->data = $data;

        $newConfEmail = new \App\adms\Models\helper\AdmsRead();
        $newConfEmail->fullRead("SELECT id, name, email, conf_email
                            FROM adms_users
                            WHERE email = :email
                            LIMIT :limit", "email={$this->data['email']}&limit=1");
        $this->resultBd = $newConfEmail->getResult();
        if ($this->resultBd) {
            $this->valConfEmail();
        } else {
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: E-mail não cadastrado!</p>";
            $this->result = false;
        }
    }

    private function valConfEmail(): void
    {
        if ((empty($this->resultBd[0]['conf_email'])) or ($this->resultBd[0]['conf_email'] == NULL)) {
            $conf_email = password_hash(date("Y-m-d H:i:s") . $this->resultBd[0]['id'], PASSWORD_DEFAULT);
            $query_activate_user = "UPDATE adms_users
            SET conf_email = :conf_email,
            modified = NOW()
            WHERE id = :id
            LIMIT :limit";

            $activate_user = $this->connectDb()->prepare($query_activate_user);
            $activate_user->bindParam(':conf_email', $conf_email);
            $activate_user->bindParam(':id', $this->resultBd[0]['id']);
            $activate_user->bindValue(':limit', 1, PDO::PARAM_INT);
            $activate_user->execute();

            if ($activate_user->rowCount()) {
                $this->resultBd[0]['conf_email']= $conf_email;
                $this->sendEmail();
            } else {
                $_SESSION['msg'] = "<p style = 'color:#f00;'>Erro: Link não enviado, tente novamente <!p>";
                $this->result = false;
               
            }
        } else {
            $this->sendEmail();
        }
    }

    private function sendEmail(): void
    {
        $sendEmail = new \App\adms\Models\helper\AdmsSendEmail();
        $this->contentEmailHtml();
        $this->contentEmailText();
        $sendEmail->sendEmail($this->emailData, 1);
        if($sendEmail->getResult()){
            $this->result = true;
            $_SESSION['msg'] = "<p style='color: #0f0;'>Novo link enviado com sucesso. Acesse a sua caixa de e-mail para confirmar o e-mail!</p>";
        }else{
            $this->fromEmail = $sendEmail->getFromEmail();
            $_SESSION['msg'] = "<p style='color: #f00;'>Usuário cadastrado com sucesso. Houve erro ao enviar o e-mail de confirmação, entre em contado com {$this->fromEmail} para mais informações!</p>";
            $this->result = false;
        }
    }

    private function contentEmailHtml(): void
    {
        $name = explode(" ", $this->resultBd[0]['name']);
        $this->firstName = $name[0];

        $this->emailData['toEmail'] = $this->data['email'];
        $this->emailData['toName'] = $this->data['name'];
        $this->emailData['subject'] = "Confirma sua conta";
        $this->url = URLADM . "conf-email/index?key=" . $this->resultBd[0]['conf_email'];

        $this->emailData['contentHtml'] = "Prezado(a) {$this->firstName}<br><br>";
        $this->emailData['contentHtml'] .= "Agradecemos a sua solicitação de cadastro em nosso site!<br><br>";
        $this->emailData['contentHtml'] .= "Para que possamos liberar o seu cadastro em nosso sistema, solicitamos a confirmação do e-mail clicanco no link abaixo: <br><br>";
        $this->emailData['contentHtml'] .= "<a href='{$this->url}'>{$this->url}</a><br><br>";
        $this->emailData['contentHtml'] .= "Esta mensagem foi enviada a você pela empresa XXX.<br>Você está recebendo porque está cadastrado no banco de dados da empresa XXX. Nenhum e-mail enviado pela empresa XXX tem arquivos anexados ou solicita o preenchimento de senhas e informações cadastrais.<br><br>";
    }

    private function contentEmailText(): void
    {
        $this->emailData['contentText'] = "Prezado(a) {$this->firstName}\n\n";
        $this->emailData['contentText'] .= "Agradecemos a sua solicitação de cadastro em nosso site!\n\n";
        $this->emailData['contentText'] .= "Para que possamos liberar o seu cadastro em nosso sistema, solicitamos a confirmação do e-mail clicanco no link abaixo: \n\n";
        $this->emailData['contentText'] .=  $this->url . "\n\n";
        $this->emailData['contentText'] .= "Esta mensagem foi enviada a você pela empresa XXX.\nVocê está recebendo porque está cadastrado no banco de dados da empresa XXX. Nenhum e-mail enviado pela empresa XXX tem arquivos anexados ou solicita o preenchimento de senhas e informações cadastrais.\n\n";
    }
}
