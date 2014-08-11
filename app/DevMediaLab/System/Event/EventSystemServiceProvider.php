<?php
namespace DevMediaLab\System\Event; 

use \Pimple\Container;
use \Pimple\ServiceProviderInterface;
use \DevMediaLab\System\Event\CoreEventSystem;
use \DevMediaLab\System\Event\Listener;
use \DevMediaLab\System\SystemEvent;
use \DevMediaLab\System\Routing\RoutingEvent;

class EventSystemServiceProvider implements ServiceProviderInterface
{    
    public function register(Container $system)
    {   
        $hookFiles = scandir( $system['paths']['hooksPath'] );
        $dirt      = array_splice( $hookFiles,0,2);
        unset($dirt);
        
        $system['hooks'] = $hookFiles;

        $system['event.system'] = function($c) {
            return new CoreEventSystem($c);
        };

        $system['event.listener'] = $system->factory(
            function($c) {
                return new Listener($c["event.system"]);
            }
        );

        /**
         * System Events
         */
        $system['system.init'] = function($c) {          
            return SystemEvent::INIT;
        };

        $system['system.boot'] = function($c) {
            return SystemEvent::BOOT;
        }; 
        
        $system['system.start'] = function($c) {
            return SystemEvent::START;
        };

        $system['system.running'] = function($c) {
            return SystemEvent::RUNNING;
        };

        $system['system.error'] = function($c) {
            return SystemEvent::ERROR;
        };

        $system['system.down'] = function($c) {
            return SystemEvent::DOWN;
        };

        $system['system.release'] = function($c) {
            return SystemEvent::RELEASE;
        };

        /**
         * Routing
         */
        $system['router.before'] = function($c) {          
            return RoutingEvent::BEFORE;
        };
        $system['router.after'] = function($c) {
            return RoutingEvent::AFTER;
        };
        $system['router.controller'] = function($c) {
            return RoutingEvent::CONTROLLER;
        };
        $system['router.error'] = function($c) {
            return RoutingEvent::ERROR;
        };
        $system['router.release'] = function($c) {
            return RoutingEvent::RELEASE;
        };

        /**
         * Register All Basic Events
         * and Basic EventHandling
         */
        $system['system.events'] = [
            $system['system.init'],
            $system['system.boot'],
            $system['system.start'],
            $system['system.running'],
            $system['system.error'],
            $system['system.down'],
            $system['system.release'],
            $system['router.before'],
            $system['router.after'],
            $system['router.controller'],
            $system['router.error'],
            $system['router.release']
        ];

        $system->bootEventListeners($system['system.events']);

    }
}



























