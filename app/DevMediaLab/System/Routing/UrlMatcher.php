<?php
namespace DevMediaLab\System\Routing; 

use \DevMediaLab\System\System;

class UrlMatcher 
{
    protected $routeCollection;
    protected $system;
    
    public function __construct(System $system)
    {
        $this->system = $system;
    }

    public function setRouteCollection(\SplObjectStorage $routeCollection)
    {
        $this->routeCollection = $routeCollection;
    }

    public function matchUrl($url,$httpMethod)
    {
        foreach ($this->routeCollection as $route) {
            if ( $route->url == $url && $route->method == $httpMethod) {
                if (is_callable($route->action)) {
                    $action=$route->action;
                    return $action($url,$this->system);
                }
            }
        }
    }

}