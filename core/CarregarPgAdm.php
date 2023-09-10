<?php

namespace Core;

class CarregarPgAdm
{
    private string $urlController;
    private string $urlMetodo;
    private string $urlParameter;
    private string $classLoad;
  

    public function loadPage(string|null $urlController, string|null  $urlMetodo, string|null $urlParameter):void
    {
        $this->urlController = $urlController;
        $this->urlMetodo = $urlMetodo;
        $this->urlParameter = $urlParameter;
   

        $this->classLoad = "\\App\\adms\\Controllers\\" . $this->urlController;
        if(class_exists($this->classLoad)){
           $this->loadMetodo();
        }else{
            die("Erro - 003: Por favor tente novamente. Caso o problema persista, entre em contato o administrador " . ADM);
         /*    $this->urlController = $this->slugController(CONTROLLER);
            $this->urlMetodo = $this->slugController(METODO);
            $this->urlParameter = "";
            $this->loadPage($this->urlController,  $this->urlMetodo, $this->urlParameter); */
        }
    }

private function loadMetodo():void
{
    $classLoad = new $this->classLoad();
    if(method_exists($classLoad, $this->urlMetodo)){
       $classLoad->{$this->urlMetodo}();
    }else{
        die("<p style='color:red'>ERRO: Por favor tente novamente. Caso o erro persista, entre em contato com o administrador <a href='#'>".ADM ."</a></p>");
    }

}




    //Deverá ser inserido em um arquivo helper
    public function slugController($slugController): string
    {
        $this->urlSlugController = $slugController;
        $this->urlSlugController= strtolower($this->urlSlugController);
        $this->urlSlugController = str_replace("-"," ", $this->urlSlugController);
        $this->urlSlugController = ucwords($this->urlSlugController);
        $this->urlSlugController = str_replace(" ","", $this->urlSlugController);
         
      
        return $this->urlSlugController;

    }

    public function slugMetodo($slugMetodo): string
    {
        $this->urlSlugMetodo = $this->slugController($slugMetodo);
        $this->urlSlugMetodo = lcfirst($this->urlSlugMetodo);
        return $this->urlSlugMetodo;
    }

}