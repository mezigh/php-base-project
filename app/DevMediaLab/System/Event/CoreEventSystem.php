<?php
namespace DevMediaLab\System\Event;

use \DevMediaLab\System\Event\ObservableInterface;
use \DevMediaLab\System\Event\Listener;
use \DevMediaLab\System\System;

class CoreEventSystem implements ObservableInterface
{
    protected $system;
    protected $coreEventSystem;
    protected $listeners;
    protected $registeredEvents;
    
    public function __construct($system)
    {
        $this->system = $system;
        $this->registeredEvents = [];
        $this->listeners = new \SplObjectStorage;
    }

    public function bootEventListeners($systemEvents)
    {    
        foreach ($systemEvents as $sysEvent) {
            $this->makeListener($sysEvent);       
            $this->addEventListener($sysEvent,function($event) {

                /* Here we can define what to do when an Event is Fired */
                $showable = "";
                foreach ( explode('::',$event) as $term ) {
                    $showable .= ucfirst(strtolower($term));
                }

                // echo $showable."\n";

                $this->checkForSystemHooks($event);

            });
        }
        $this->notifyToListener($this->system['system.init']);
    }

    public function checkForSystemHooks($event)
    {
        $hooks = $this->system['hooks'];
        $hooksPath = $this->system['paths']['hooksPath'];
        $hookFileName = strtolower(explode('::',$event)[1]).'.php';
        
        if (in_array($hookFileName, $hooks)) {
            require_once $hooksPath.'/'.$hookFileName;
        }
    }

    /**
     * [makeListener description]
     * @param  [type] $event [description]
     * @return [type]        [description]
     */
    protected function makeListener($event)
    {
        $listener = $this->system['event.listener'];
        $listener->setEvent($event);
        $this->registeredEvents[$event] = $listener;
        $this->addListener($listener);
    }

    public function createEventAndListener($eventType, $callback)
    {
        
        if (!array_key_exists($eventType,$this->getRegisteredEvents())) {
            $this->makeListener($eventType);
            $this->getRegisteredEvents()[$eventType]->setCallBack($callback);
        }

        //var_dump($this->getRegisteredEvents()["HTTP_REQUEST::BEFORE"]);
    }

    public function addEventListener($eventType,$callback)
    {
        if ($this->isValidEventType($eventType)) {
            $this->getRegisteredEvents()[$eventType]->setCallBack($callback);
            $this->system->setInternalState($eventType);
        }
    }

    protected function isValidEventType($eventType)
    {
        if (!array_key_exists($eventType,$this->getRegisteredEvents())) {
            throw new \Exception("No Listener for this EventType: $eventType", 1);
        }
        return true;
    }

    public function addListener(ListenerInterface $listener)
    {   
        $this->listeners->attach($listener);
    }
    
    public function removeListener(ListenerInterface $listener)
    {
        $this->listeners->detach($listener);
    }

    public function notifyToListener($eventType)
    {
        // echo "$this NOTIFY >>> $eventType\n";
        $listener = $this->getRegisteredEvents()[$eventType];
        $listener->executeCallback($listener->getCallback());
    }

    /**
     * Gets the value of registeredEvents.
     *
     * @return mixed
     */
    public function getRegisteredEvents()
    {
        return $this->registeredEvents;
    }

    public function __toString()
    {
        $reflexo = new \ReflectionClass($this);
        return $reflexo->getShortName();
    }
}