<?php
namespace DevMediaLab\System\Routing; 
    
class RoutingEvent 
{
    const BEFORE     = "ROUTER::BEFORE";
    const AFTER      = "ROUTER::AFTER";
    const CONTROLLER = "ROUTER::CONTROLLER";
    const ERROR      = "ROUTER::ERROR";
    const RELEASE    = "ROUTER::RELEASE";

    public function __toString()
    {
        $reflexo = new \ReflectionClass($this);
        return $reflexo->getShortName();
    }
    
}