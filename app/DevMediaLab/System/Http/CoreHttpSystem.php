<?php
namespace DevmediaLab\System\Http; 

use \DevmediaLab\System\Http\Request;
use \DevmediaLab\System\Http\Response; 

class CoreHttpSystem 
{
    protected $system;
    protected $request;
    protected $response;

    public function __construct($system)
    {
        $this->system = $system;    
    }

    
    /**
     * Gets the value of request.
     *
     * @return mixed
     */
    public function getRequest()
    {
        return $this->request;
    }
    
    /**
     * Sets the value of request.
     *
     * @param mixed $request the request 
     *
     * @return self
     */
    public function setRequest($request)
    {
        $this->request = $request;

        return $this;
    }
    
    /**
     * Sets the value of response.
     *
     * @param mixed $response the response 
     *
     * @return self
     */
    public function setResponse($response)
    {
        $this->response = $response;

        return $this;
    }

}