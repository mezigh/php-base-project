<?php
namespace DevMediaLab\System\Routing; 

class Controller
{
    

    public function __toString()
    {
        $reflexo = new \ReflectionClass($this);
        return $reflexo->getShortName();
    }

}