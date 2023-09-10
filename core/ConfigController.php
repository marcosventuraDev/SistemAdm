<?php
namespace Core;

class ConfigController extends  Config
{
    private string $url;
    private array $urlArray;
    private string $urlController;
    private string $urlMetodo;
    private string $urlParameter;
    private string $classLoad;
    private object $classPage;
    private array $format;
    private string $urlSlugController;
    private string $urlSlugMetodo;

    public function __construct()
    {
        $this->configAdm();
        if (!empty(filter_input(INPUT_GET, 'url', FILTER_DEFAULT))) {
            $this->url = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);

            $this->clearUrl();

            $this->urlArray = explode('/', $this->url);
       

            if (isset($this->urlArray[0])) {
                $this->urlController = $this->slugController($this->urlArray[0]);
            } else {
                $this->urlController = $this->slugController(CONTROLLER);
            }

            if (isset($this->urlArray[1])) {
                $this->urlMetodo = $this->slugMetodo($this->urlArray[1]);
            } else {
                $this->urlMetodo = $this->slugMetodo(METODO);
            }
            if (isset($this->urlArray[2])) {
                $this->urlParameter = $this->urlArray[2];
            } else {
                $this->urlParameter = "";
            }
        } else {
            $this->urlController = CONTROLLERERRO;
            $this->urlMetodo = METODO;
            $this->urlParameter = "";
        }

    }

    private function clearUrl(): void
    {
        $this->url = strip_tags($this->url);
        $this->url =  trim($this->url);
        $this->url = rtrim($this->url, "/");
    
        $this->format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]?;:.,\\\'<>°ºª ';
        $this->format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr-------------------------------------------------------------------------------------------------';

        $this->url = strtr(
            mb_convert_encoding($this->url,'ISO-8859-1', 'UTF-8'),
            mb_convert_encoding($this->format['a'],'ISO-8859-1','UTF-8'),
            $this->format['b']
        );
    }

    
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



    public function loadPage():void
    {

      /*   $this->urlController = ucwords($this->urlController);
        $this->classLoad = "\\App\\adms\\Controllers\\".$this->urlController;
        $this->classPage = new $this->classLoad();
        $this->classPage->{$this->urlMetodo}(); */

        $loadPgAdm = new \Core\CarregarPgAdm();
        $loadPgAdm->loadPage($this->urlController, $this->urlMetodo, $this->urlParameter);

    }
}
