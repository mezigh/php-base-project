<?php
namespace DevMediaLab\System\Http;

class Response
{
    
    protected $content;


    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }


    public function toJson()
    {
        return json_encode($this->getContent());  
    }

    public function toArray()
    {
        
    }
}
