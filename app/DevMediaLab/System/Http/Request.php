<?php
namespace DevMediaLab\System\Http; 

class Request  
{
    protected $url;
    protected $method;
    protected $params;

    public function setRequest($url,$method)
    {
        $this->url    = $url;
        $this->method = $method;
    }

    public function segments()
    {
        return  explode('/',$this->url);
    }

    public function segment($segmId)
    {
        return  explode('/',$this->url)[$segmId];
    }

    public function isAjax()
    {

    }

    /**
     * Gets the value of url.
     *
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }
    
    /**
     * Gets the value of method.
     *
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }


}