<?php
namespace DevMediaLab\System\Routing; 

use \Pimple\Container;
use \Pimple\ServiceProviderInterface;
use \DevMediaLab\System\Environment;
use \DevMediaLab\System\Routing\CoreRoutingSystem;
use \DevMediaLab\System\Routing\Controller;
use \DevMediaLab\System\Routing\UrlMatcher;

class RoutingServiceProvider implements ServiceProviderInterface
{
    
    public function register(Container $system)
    {       
        $system['router'] = function($c) {
            return new CoreRoutingSystem($c);
        };

        $system['controller'] = $system->factory(
            function($c) {
                return new Controller;
            }
        );

        $system['urlmatcher'] = function($c) {
            return new UrlMatcher($c); 
        };

        $system['request.environment'] = function($c) {
            return Environment::getInstance(); 
        };

    }


}