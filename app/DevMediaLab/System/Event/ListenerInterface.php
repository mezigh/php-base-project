<?php
namespace DevMediaLab\System\Event; 

use \DevMediaLab\System\Event\ObservableInterface;

interface ListenerInterface 
{
    public function update(ObservableInterface $observable);   
}