<?php
namespace DevMediaLab\System\Html; 

use \DevMediaLab\System\Html\HtmlElement;

class HtmlComponent
{
    protected $htmlElements;
    protected $schema;
    protected $mainContainer;

    public function __construct()
    {
        $this->htmlElements = [];
    }


    public function addElement( $htmlElements)
    {
        $this->htmlElements[] = $htmlElements;
    }

    
    public function mainContainer($htmlTag,$class="" , $content)
    {
        
        var_dump($content);
        return "<$htmlTag class='".$class."'>".PHP_EOL.$content.PHP_EOL."</$htmlTag>".PHP_EOL;
    }

    public function updateComponent()
    {

    }

    public function link($href,$text)
    {
        return "<a href='".$href."'>" . $text."</a>";
    }

    public function wrapWith($htmlTag, $params)
    {
        return "<$htmlTag>".$params['content']."</$htmlTag>".PHP_EOL;
    }

    public function specialwrapWith($htmlTag, $params)
    {
        switch ($htmlTag) {
            case 'img':
                return "<$htmlTag src=''>".PHP_EOL;    
                break;
            case 'input':
                return "<$htmlTag type='' name='' id='' value=''> ".PHP_EOL;
                break;
            default:
                throw new \Exception("The htmltag: is not yet supported!", 1);
                break;
        }
    }

    public function paramsExploder($params)
    {
        foreach ($params as $key ) {
            echo "► ► ► ►\n";
            var_dump($key);
        }

    }

    public function buildComponent()
    {

    }

    /**
     * Gets the value of schema.
     *
     * @return mixed
     */
    public function getSchema()
    {
        return $this->schema;
    }

    /**
     * Sets the value of schema.
     *
     * @param mixed $schema the schema 
     *
     * @return self
     */
    public function setSchema($schema)
    {
        $this->schema = $schema;

        return $this;
    }


    /**
     * Gets the value of mainContainer.
     *
     * @return mixed
     */
    public function getMainContainer()
    {
        return $this->mainContainer;
    }
    
    /**
     * Sets the value of mainContainer.
     *
     * @param mixed $mainContainer the main container 
     *
     * @return self
     */
    protected function setMainContainer($mainContainer)
    {
        $this->mainContainer = $mainContainer;

        return $this;
    }

    /**
     * Gets the value of htmlElements.
     *
     * @return mixed
     */
    public function getHtmlElements()
    {
        return $this->htmlElements;
    }

}