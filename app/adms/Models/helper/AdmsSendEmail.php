<?php

namespace App\adms\Models\helper;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class AdmsSendEmail
{
    private array $data;

    private array $dataInfoEmail;

    private array|null $resultBd;

    private bool $result;

    private string $fromEmail = EMAILADM;

    private int $optionConfEmail;

   
    function getResult(): bool
    {
        return $this->result;
    }

     function getFromEmail(): string
    {
        return $this->fromEmail;
    }

    public function sendEmail(array $data, int $optionConfEmail): void
    {
        $this->optionConfEmail = $optionConfEmail;
        $this->data = $data;

        $this->infoPhpMailer();
    }

    private function infoPhpMailer(): void
    {
        $confEmail = new \App\adms\Models\helper\AdmsRead();
        $confEmail->fullRead("SELECT name, email, host, username, password, smtpsecure, port FROM adms_confs_emails WHERE id =:id LIMIT :limit", "id={$this->optionConfEmail}&limit=1");
        $this->resultBd = $confEmail->getResult();
        if ($this->resultBd) {
            $this->dataInfoEmail['host'] = $this->resultBd[0]['host'];
            $this->dataInfoEmail['fromEmail'] = $this->resultBd[0]['email'];
            $this->fromEmail = $this->dataInfoEmail['fromEmail'];
            $this->dataInfoEmail['fromName'] = $this->resultBd[0]['name'];
            $this->dataInfoEmail['username'] = $this->resultBd[0]['username'];
            $this->dataInfoEmail['password'] = $this->resultBd[0]['password'];
            $this->dataInfoEmail['smtpsecure'] = $this->resultBd[0]['smtpsecure'];
            $this->dataInfoEmail['port'] = $this->resultBd[0]['port'];

            $this->sendEmailPhpMailer();
        } else {
            $this->result = false;
        }
    }

    private function sendEmailPhpMailer(): void
    {
        $mail = new PHPMailer(true);

        try {
    
            $mail->CharSet = 'UTF-8';
            $mail->isSMTP();
            $mail->Host       = $this->dataInfoEmail['host'];
            $mail->SMTPAuth   = true;
            $mail->Username   = $this->dataInfoEmail['username'];
            $mail->Password   = $this->dataInfoEmail['password'];
            $mail->SMTPSecure = $this->dataInfoEmail['smtpsecure'];
            $mail->Port       = $this->dataInfoEmail['port'];

            $mail->setFrom($this->dataInfoEmail['fromEmail'], $this->dataInfoEmail['fromName']);
            $mail->addAddress($this->data['toEmail'], $this->data['toName']);

            $mail->isHTML(true);
            $mail->Subject = $this->data['subject'];
            $mail->Body    = $this->data['contentHtml'];
            $mail->AltBody = $this->data['contentText'];

            $mail->send();

            $this->result = true;
        } catch (Exception $e) {
            $this->result = false;
        }
    }
}
