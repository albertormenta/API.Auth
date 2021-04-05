<?php
namespace Start;

class Start{

    protected $controlador = 'Home';
    protected $metodo = 'home';

    public function __construct()
    {
        $url = $this->getUrl();
        try {
                $this->appi($url);                 
        } catch (\Exception $e) {
            echo $e->getMessage(), "\n";
        }
    }
    private function appi($url){
        call_user_func([$this->BuscaControlador($url), $this->BuscaMetodo($url)], $this->EnviaArreglo($url));        
    }
    private function getUrl (){
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
    private function BuscaControlador($url){
        $UrlController = ucwords(explode('.', $url[0])[0]);

        $Controller = empty($UrlController) || strtolower($UrlController) == "index" ? $this->controlador : $UrlController;

        if(file_exists('Controllers/' . $Controller . 'Controller.php')){
            require_once 'Controllers/' . $Controller . 'Controller.php';
            return $this->controlador = $Controller;
            unset($url[0]);
        }
        else {
           throw new \Exception ('Controlador ' . $Controller . ' No encontrado' );

        }
    }
    private function BuscaMetodo($url){
        $Method = isset($url[1]) == "" ? $this->metodo : $url[1];
        if (method_exists($this->controlador, $Method)) {
            return $this->metodo = $Method ;
        }else {
            throw new \Exception ('Metodo ' . $Method . ' No encontrado' );
        }

    }

    private function EnviaArreglo($url){
       
        return $url == "" ? $url : [$this->controlador, $this->metodo];
    }

}