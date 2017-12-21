<?php

namespace Core;
use \Klein\Klein;
/**
 * Router
 *
 * PHP version 7.0
 */
class Router extends Klein{
    // /**
    // * Parameters from the matched route
    // * @var array
    // */
    //protected $params = [];

    public function respondWithController($method, $path = '*', $controllerAction)
    {
        $handler = explode('@',$controllerAction);
        $controller = $handler[0];
        $action = $handler[1];
        $controller = $this->getNamespace() . $controller;
        if (class_exists($controller)) {
            //$callback = [new $controller($this->params),$action];
            $callback = [new $controller(),$action];
            parent::respond($method, $path, $callback);    
        } else {
            throw new \Exception("Controller class $controller not found");
        }
    }
    /**
     * Get the namespace for the controller class. The namespace defined in the
     * route parameters is added if present.
     *
     * @return string The request URL
     */
    protected function getNamespace()
    {
        $namespace = 'App\Controllers\\';

        //if (array_key_exists('namespace', $this->params)) {
        //    $namespace .= $this->params['namespace'] . '\\';
        //}

        return $namespace;
    }
}
