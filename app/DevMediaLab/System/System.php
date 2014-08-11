<?php
namespace DevMediaLab\System; 

use \DevMediaLab\System\Event\CoreEventSystem;
use \Pimple\Container;

class System extends Container 
{        
    public static $version="0.1.0";
    public static $name="WebSystem";
    protected $internalState;
    protected $hooks;
    protected $request;
    protected $response;

    public function __construct($path, $appConf)
    {
        parent::__construct();

        $this['paths'] = $path;
        $this['appConf'] = $appConf;
        $this->loadEarlyProviders();
    }

    protected function loadEarlyProviders()
    {
        $eventServiceProvider = new \DevMediaLab\System\Event\EventSystemServiceProvider;
        $eventServiceProvider->register($this);
    }

    public function bootEventListeners($systemEvents)
    {
        $this['event.system']->bootEventListeners($systemEvents);
        $this->loadProviders($this['appConf']);
    }

    protected function loadProviders($providers)
    {
        $this['event.system']->notifyToListener($this['system.boot']);

        foreach ($providers['providers'] as $provider) {
            $service = new $provider;
            $service->register($this);
        }

        $this['event.system']->notifyToListener($this['system.start']);
    }

    public function handleHttp($requestEnvironment)
    {
        $this['event.system']->notifyToListener($this['system.running']);
        $url = $requestEnvironment->properties['PATH_INFO'];
        $httpMethod = strtolower($requestEnvironment->properties['REQUEST_METHOD']);
        $this['event.system']->notifyToListener($this['router.before']);
        $this->request = $this['http.request']; 
        $this->request->setRequest($url,$httpMethod);

        if ( $this['router']->matchUrl($url, $httpMethod) instanceof \DevMediaLab\System\Http\Response ) {
            $this->response = $this['router']->matchUrl($url, $httpMethod);
        } else {
            $this->response = $this['http.response'];
            $this->response->setContent($this['router']->matchUrl($url, $httpMethod));
        }

        $this['event.system']->notifyToListener($this['router.after']);
    }

    public function sendResponse()
    {
        $this['event.system']->notifyToListener($this['system.release']);
        return $this->response->getContent();
    }
    
    /**
     * Gets the value of internalState.
     *
     * @return mixed
     */
    public function getInternalState()
    {
        return $this->internalState;
    }
    
    /**
     * Sets the value of internalState.
     *
     * @param mixed $internalState the internal state 
     *
     * @return self
     */
    public function setInternalState($internalState)
    {
        $this->internalState = $internalState;
    }

    /**
     * Gets the value of systemEvents.
     *
     * @return mixed
     */
    public function getSystemEvents()
    {
        return $this->systemEvents;
    }

    public function getName()
    {
        $reflexo = new \ReflectionClass($this);
        return $reflexo->getShortName();
    }
    
    public function __toString()
    {
        return $this->getName();
    }

}