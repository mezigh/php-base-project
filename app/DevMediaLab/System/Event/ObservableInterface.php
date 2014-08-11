<?php
namespace DevMediaLab\System\Event; 

use \DevMediaLab\System\Event\ListenerInterface;  

interface ObservableInterface 
{
    public function addListener(ListenerInterface $listener);
    public function removeListener(ListenerInterface $listener);
    public function notifyToListener($eventType);
}