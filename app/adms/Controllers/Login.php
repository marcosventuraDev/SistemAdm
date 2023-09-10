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
            $valLogin = new \App\adms\Models\AdmsLogin();
            $valLogin->login($this->dataForm);
            if($valLogin->getResult()){
              $urlRedirect =  URLADM . "dashboard/index";
              header("Location: $urlRedirect");
            }else{
                $this->data['form'] = $this->dataForm;
            }
            
        }

        $loadView = new \Core\ConfigView("adms/Views/login/login", $this->data);
        $loadView->loadView();
    
    }//end index
}//end class