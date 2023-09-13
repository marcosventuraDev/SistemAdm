<?php

namespace App\adms\Controllers;

class NewUser
{
    private array|null|string $data = [];
    private array|null|string $dataForm;
    public function index(): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (!empty($this->dataForm["SendNewUser"])) {
            unset($this->dataForm['SendNewUser']);
            $createNewLogin = new \App\adms\Models\AdmsNewUser();
            $createNewLogin->create($this->dataForm);
            if ($createNewLogin->getResult()) {
                $urlRedirect =  URLADM;
              header("Location: $urlRedirect");
            } else {
                $this->data['form'] = $this->dataForm;
                $this->viewNewUser();
            }
        } else {
            $this->viewNewUser();
        }
    } //end index
    private function viewNewUser(): void
    {
        $loadView = new \Core\ConfigView("adms/views/login/newUser", $this->data);
        $loadView->loadView();
    }
}//end class