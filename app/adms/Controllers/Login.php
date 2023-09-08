<?php
namespace App\adms\Controllers;
class Login
{
    private array|null|string $data = [];
    private array|null|string $dataForm;
    public function index(): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if(!empty($this->dataForm["SendLogin"])){
            var_dump($this->dataForm);
            $this->data['form'] = $this->dataForm;
        }


        $loadView = new \Core\ConfigView("adms/Views/login/login", $this->data);
        $loadView->loadView();
    }
}