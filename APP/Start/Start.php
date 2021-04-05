<?php

namespace Start;

use Lib\JsonResponse;

class Start
{

    protected $controlador = 'Home';
    protected $metodo = 'home';

    public function __construct()
    {
        $url = $this->getUrl();
        try {
            $this->appi($url);
        } catch (\Exception $e) {
            $response = new JsonResponse;
            $code = 400;
            $message = $e->getMessage();
            $result = $response->response($code, $message);

            echo json_encode($result);
        }
    }
    private function appi($url)
    {
        try {
            call_user_func([$this->BuscaControlador($url), $this->BuscaMetodo($url)], $this->EnviaArreglo($url));
        } catch (\Exception $e) {
            $response = new JsonResponse;
            $code = 400;
            $message = $e->getMessage();
            $result = $response->response($code, $message);

            echo json_encode($result);
        }
    }
    private function getUrl()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
    private function BuscaControlador($url)
    {
        $UrlController = ucwords(explode('.', $url[0])[0]);

        $Controller = empty($UrlController) || strtolower($UrlController) == "index" ? $this->controlador : $UrlController;

        if (file_exists('Controllers/' . $Controller . 'Controller.php')) {
            require_once 'Controllers/' . $Controller . 'Controller.php';
            return $this->controlador = $Controller;
            unset($url[0]);
        } else {
            $response = new JsonResponse;
            $code = 400;
            $message = 'Controlador ' . $Controller . ' No encontrado';
            $result = $response->response($code, $message);

            echo json_encode($result);
        }
    }
    private function BuscaMetodo($url)
    {
        $Method = isset($url[1]) == "" ? $this->metodo : $url[1];
        if (method_exists($this->controlador, $Method)) {
            return $this->metodo = $Method;
        } else {
            $response = new JsonResponse;
            $code = 400;
            $message = 'Metodo ' . $Method . ' No encontrado';
            $result = $response->response($code, $message);

            echo json_encode($result);
        }
    }

    private function EnviaArreglo($url)
    {

        return $url == "" ? $url : [$this->controlador, $this->metodo];
    }
}
