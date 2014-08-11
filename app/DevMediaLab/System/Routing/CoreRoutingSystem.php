<?php
namespace DevMediaLab\System\Routing; 

class CoreRoutingSystem
{
    public $route;
    public $routeCollection;
    protected $system;
    protected $urlMatcher;
    
    public function __construct($system)
    {
        $this->system = $system;
        $this->routeCollection = new \SplObjectStorage;
        $this->urlMatcher = $this->system['urlmatcher'];
        $this->urlMatcher->setRouteCollection($this->routeCollection);
    }

    protected function get($url,$params)
    {        
        try {
            $params($url,$this->system);
        } catch (Exception $e) {
            throw new \Exception("The route action provided is NOT callable", 1);
        }
    }

    protected function post($url,$params)
    {
        try {
            $params($url,$this->system);
        } catch (Exception $e) {
            throw new \Exception("The route action provided is NOT callable", 1);
        }
    }

    public function patch($url,$params)
    {
        try {
            $params($url,$this->system);
        } catch (Exception $e) {
            throw new \Exception("The route action provided is NOT callable", 1);
        }
    }

    public function delete($url,$params)
    {
        try {
            $params($url,$this->system);
        } catch (Exception $e) {
            throw new \Exception("The route action provided is NOT callable", 1);
        }
    }

    /**
     * [matchUrlwitRoute description]
     * @param  string $url given by Environment
     * @return [type]      [description]
     */
    public function matchUrl($url,$httpMethod)
    {
        return $this->urlMatcher->matchUrl($url,$httpMethod);
    }

    public function addRoute($routeName)
    {
        $this->routeCollection->attach($routeName);
    }

    public function getRoutes()
    {
        return $this->routeCollection;
    }

    public function __call($method,$args)
    {
        $route = new \StdClass();
        $route->method = $method;
        $route->url = $args[0];
        $route->action = $args[1];
        $this->addRoute($route);

        switch ($method) {

            case 'get':
                $this->$method($args[0], $args[1]);
                break;

            case 'post':
                $this->$method($args[0], $args[1]);
                break;

            case 'patch':
                $this->$method($args[0], $args[1]);
                break;

            case 'delete':
                $this->$method($args[0], $args[1]);
                break;

            default:
                throw new \Exception("Method:" . $method . " not allowed", 1);
                break;
        }
    }

    public function __toString()
    {
        $reflexo = new \ReflectionClass($this);
        return $reflexo->getShortName();
    }


}