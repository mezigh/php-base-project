<?php
namespace DevMediaLab\System; 
    
class SystemEvent 
{
    const INIT    = "SYSTEM::INIT";
    const BOOT    = "SYSTEM::BOOT";
    const START   = "SYSTEM::START";
    const RUNNING = "SYSTEM::RUNNING";
    const ERROR   = "SYSTEM::ERROR";
    const DOWN    = "SYSTEM::DOWN";
    const RELEASE = "SYSTEM::RELEASE";

    public function __toString()
    {
        $reflexo = new \ReflectionClass($this);
        return $reflexo->getShortName();
    }
    
}