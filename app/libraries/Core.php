<?php

/* 
 * App core class
 * Creates URL & loads core controller
 * URL Format - /controller/method/params
*/

class Core
{
    protected $currentController = 'PageController';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct()
    {

        $url = $this->getUrl();

        // Look in controllers for first index or value
        if (isset($url[0]) && file_exists('../app/controllers/' . ucfirst($url[0]) . '.php')) {
            // If exists, set as controller
            $this->currentController = ucfirst($url[0]);
            // Unset 0 index
            unset($url[0]);
        }

        // Require the controller
        require_once '../app/controllers/' . $this->currentController . '.php';

        // Instantiate controller class
        $this->currentController = new $this->currentController;
        // check for second part of url and  method exists in controller
        if (isset($url[1]) && method_exists($this->currentController, $url[1])) {

            $this->currentMethod = $url[1];

            // unset $url[1]
            unset($url[1]);
        }

        // Get params
        $this->params = $url ? array_values($url) : [];

        // Call a callback with array of params
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}
