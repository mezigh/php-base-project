<?php
namespace DevMediaLab\System\Event;

use \DevMediaLab\System\Event\ListenerInterface;
use \DevMediaLab\System\Event\ObservableInterface;

class Listener implements ListenerInterface  
{
    protected $caller;
    protected $event;
    protected $callback;

    public function __construct($caller)
    {
        $this->caller    = $caller;
    }

    public function update(ObservableInterface $observable)
    {
        $eventType = "Event";
        foreach (explode("::", $this->getEvent()) as $exploded ) {
            $eventType .= ucfirst(strtolower($exploded));
        } 
    }

    public function executeCallback(\Closure $callback)
    {
        // echo "EXECUTING THE CALLBACK FOR : ". $this->event ."\n";
        $callback($this->event);
    }

    public function __toString()
    {
        $reflexo = new \ReflectionClass($this);
        return $reflexo->getShortName()."::".$this->getEvent();
    }

    /**
     * Gets the value of callbacks.
     *
     * @return mixed
     */
    public function getCallback()
    {
        return $this->callback;
    }
    
    /**
     * Sets the value of callbacks.
     *
     * @param mixed $callbacks the callbacks 
     *
     * @return self
     */
    public function setCallback($callback)
    {
        $this->callback = $callback;

        return $this;
    }

    /**
     * Sets the value of event.
     *
     * @param mixed $event the event 
     *
     * @return self
     */
    public function setEvent($event)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Gets the value of event.
     *
     * @return mixed
     */
    public function getEvent()
    {
        return $this->event;
    }


    /**
     * Gets the value of caller.
     *
     * @return mixed
     */
    public function getCaller()
    {
        return $this->caller;
    }

}