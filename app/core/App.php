<?php
class App 
{
    protected $controller = 'home';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseURL();

        // karena nilai $url null maka tidak dapat dicari ke file nya alias error
        if ($url === NULL) {$url = [$this->controller];}
        
          // check file controller
        if (file_exists('app/controllers/'. $url[0] .'.php')) {
            $this->controller = $url[0];
            unset($url[0]);
        }else {
            die("Error: The file does not exist.");
        }
        require_once 'app/controllers/'. $this->controller .'.php';
        $this->controller = new $this->controller;


        //method
        if (isset($url[1])) {
            if(method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        //params 
        if (!empty($url)) {
            $this->params = array_values($url);
        }

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    // start with parseURL
    public function parseURL()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/'); // deleted "/" at the end
            $url = filter_var($url, FILTER_SANITIZE_URL); //clear url
            $url = explode('/', $url); //memecahkan url menjadi array
            return $url;
        }
    }
}