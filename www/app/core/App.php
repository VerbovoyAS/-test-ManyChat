<?php

class App
{
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];

    private const CONTROLLER = 0;
    private const METHOD = 1;

    public function parserUrl()
    {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_STRING));
        }
    }

    public function __construct()
    {
        $url = $this->parserUrl();

        if ($url !== null) {
            if (file_exists('app/controller/' . ucfirst($url[self::CONTROLLER]) . '.php')) {
                $this->controller = ucfirst($url[self::CONTROLLER]);
                unset($url[self::CONTROLLER]);
            }
        }

        // Подключаем сам файл контроллера
        require_once 'app/controller/' . $this->controller . '.php';

        $this->controller = new $this->controller;
        if (isset($url[self::METHOD])) {
            if (method_exists($this->controller, $url[self::METHOD])) {
                $this->method = $url[self::METHOD];
                unset($url[self::METHOD]);
            }
        }

        $this->params = $url ? array_values($url) : [];
        
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

}