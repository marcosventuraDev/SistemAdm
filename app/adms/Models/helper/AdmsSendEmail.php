<?php

namespace App\adms\Models\helper;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class AdmsSendEmail
{
    private array $data;
    private array $dataInfoEmail;
    private bool $result;
    private string $fromEmail;

    public function getResult(): bool
    {
        return $this->result;
    }

    public function sendEmail(): void
    {
        $this->dataInfoEmail['host'] = 'sandbox.smtp.mailtrap.io';
        $this->dataInfoEmail['fromEmail'] = 'atendimento@marcosventura.com';
        $this->fromEmail =  $this->dataInfoEmail['fromEmail'];
        $this->dataInfoEmail['fromName'] = 'marcos';
        $this->dataInfoEmail['username'] = 'aeded8c7ed35ad';
        $this->dataInfoEmail['password'] = '502ca6c7066f6f';
        $this->dataInfoEmail['port'] = 587;

        $this->data['toEmail'] = "joaomarcosv711@gmail.com";
        $this->data['toName'] = "joao Marcos";
        $this->data['subject'] = "Confirma e-mail";
        $this->data['contentHtml'] = "Olá <b>João marcos</b><br> <p>Cadastro realizado com sucesso!</p>";
        $this->data['contentText'] = "Olá João marcos \n\n Cadastro realizado com sucesso!";

        $this->sendEmailPhpMailer();
    }

    private function sendEmailPhpMailer(): void
    {
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;

            $mail->CharSet='UTF-8';
            
            $mail->isSMTP();
            $mail->Host       = $this->dataInfoEmail['host'];
            $mail->SMTPAuth   = true;
            $mail->Username   = $this->dataInfoEmail['username'];
            $mail->Password   = $this->dataInfoEmail['password'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       =  $this->dataInfoEmail['port'];

            //Recipients
            $mail->setFrom($this->dataInfoEmail['fromEmail'], $this->dataInfoEmail['fromName']);
            $mail->addAddress($this->data['toEmail'],  $this->data['toName']);

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject =  $this->data['subject'];
            $mail->Body    = $this->data['contentHtml'];
            $mail->AltBody =  $this->data['contentText'];

            $mail->send();
            $this->result = true;
        } catch (Exception $e) {
            $this->result = false;
            
        }
    }
}
