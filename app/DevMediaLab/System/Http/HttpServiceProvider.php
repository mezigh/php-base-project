<?php
namespace DevMediaLab\System\Http; 

use \Pimple\Container;
use \Pimple\ServiceProviderInterface;
use \DevMediaLab\System\Http\Request;
use \DevMediaLab\System\Http\Response;

class HttpServiceProvider implements ServiceProviderInterface
{
    public function register(Container $system)
    {
        $system['http.request'] = function($c) {
            return new Request;
        };

        $system['http.response'] = function($c) {
            return new Response;
        };
    }
    
}