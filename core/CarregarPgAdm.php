<?php

namespace Core;

class CarregarPgAdm
{
    private string $urlController;
    private string $urlMetodo;
    private string $urlParameter;
    private string $classLoad;
    private array $listPgPublic;
    private array $listPgPrivate;

    private string $urlSlugController;
    private string $urlSlugMetodo;


    public function loadPage(string|null $urlController, string|null  $urlMetodo, string|null $urlParameter): void
    {
        $this->urlController = $urlController;
        $this->urlMetodo = $urlMetodo;
        $this->urlParameter = $urlParameter;

        $this->pgPublic();

        if (class_exists($this->classLoad)) {
            $this->loadMetodo();
        } else {
            die("Erro - 003: Por favor tente novamente. Caso o problema persista, entre em contato o administrador " . ADM);
        }
    }

    private function loadMetodo(): void
    {
        $classLoad = new $this->classLoad();
        if (method_exists($classLoad, $this->urlMetodo)) {
            $classLoad->{$this->urlMetodo}();
        } else {
            die("<p style='color:red'>ERRO: Por favor tente novamente. Caso o erro persista, entre em contato com o administrador <a href='#'>" . ADM . "</a></p>");
        }
    }


    private function pgPublic(): void
    {
        $this->listPgPublic = ["Login"];

        if (in_array($this->urlController, $this->listPgPublic)) {
            $this->classLoad = "\\App\\adms\\Controllers\\" . $this->urlController;
        } else {
            $this->PgPrivate();
        }
    }

    private function pgPrivate(): void
    {
        $this->listPgPrivate = ["Dashboard"];
        if (in_array($this->urlController, $this->listPgPrivate)) {
            $this->verifyLogin();
        } else {
            $_SESSION['msg'] = "<p style='color:red'>Erro: Página não encontrada!<p/>";
            $urlRedirect =  URLADM . "login/index";
            header("Location: $urlRedirect");
        }
    }

    private function verifyLogin(): void
    {
        if ((isset($_SESSION['user_id'])) and (isset($_SESSION['user_name'])) and (isset($_SESSION['user_email']))) {
            $this->classLoad = "\\App\\adms\\Controllers\\" . $this->urlController;
        } else {
            $_SESSION['msg'] = "<p style='color:red'>Erro: Para acessar a página realize o login!<p/>";
            $urlRedirect =  URLADM . "login/index";
            header("Location: $urlRedirect");
        }
    }


    //Deverá ser inserido em um arquivo helper
    public function slugController($slugController): string
    {
        $this->urlSlugController = $slugController;
        $this->urlSlugController = strtolower($this->urlSlugController);
        $this->urlSlugController = str_replace("-", " ", $this->urlSlugController);
        $this->urlSlugController = ucwords($this->urlSlugController);
        $this->urlSlugController = str_replace(" ", "", $this->urlSlugController);


        return $this->urlSlugController;
    }

    public function slugMetodo($slugMetodo): string
    {
        $this->urlSlugMetodo = $this->slugController($slugMetodo);
        $this->urlSlugMetodo = lcfirst($this->urlSlugMetodo);
        return $this->urlSlugMetodo;
    }
}
