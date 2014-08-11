<?php
namespace DevMediaLab\System\Html; 

use \DevMediaLab\System\Html\HtmlComponent;

class Menu extends HtmlComponent
{
    protected $params;

    public function __construct(\Array $segments,\Array $params)
    {
        parent::__construct();
        $this->params = $params;
    }

    protected function parseParams($params)
    {
        $menuItem = new \StdClass();
        $menuItem->type = "";
        $menuItem->title = "";
        $menuItem->link = "";
        $menuItem->disabledLink = "";
        $menuItem->subitems = false;

        $menu = [
            "logo-brand" => ['title'=>"WebSystem", "logo" => "",'link'=>"/"],
            "items" => [
                ['title'=>"Blog",'link'=>"/blog"],
                ['title'=>"About",'link'=>"/about"],
                ['title'=>"Info",'disabledLink'=>"/info", 
                    ["subitems"=>
                        [
                            ['title'=>"Url",'link'=>"/info/url"],
                            ['title'=>"Http Method",'link'=>"/info/HttpMethod"],
                            ['title'=>"Routes",'link'=>"/info/routes"],
                            ['divider'],
                            ['title'=>"View",'link'=>"/info/view"],
                            ['divider'],
                            ['title'=>"current Url",'disabledLink'=>"/$segment" ]
                        ]
                    ]   // end subitems
                ],
                ['title'=>"Contact",'link'=>"/contact"]
            ]//end items
        ];  

    }

}