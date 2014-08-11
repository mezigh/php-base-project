<?php
namespace DevMediaLab\System\Html;

use \Pimple\Container;
use \Pimple\ServiceProviderInterface;
use \DevMediaLab\System\Html\HtmlComponent;

class HtmlServiceProvider implements ServiceProviderInterface 
{
    
    public function register(Container $system)
    {
        $system['html.component'] = $system->factory(
            function($c) {
                return new HtmlComponent();
            }
        );
    }

}