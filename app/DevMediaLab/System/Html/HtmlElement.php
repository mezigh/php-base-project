<?php
namespace DevMediaLab\System\Html; 

class HtmlElement 
{
    
    protected $htmlTags;
    protected $htmlClass;
    protected $htmlAttr;

    public function __construct()
    {
        
    }

    public function buildElement()
    {
        return $this;
    }


    /**
     * Gets the value of htmlTags.
     *
     * @return mixed
     */
    public function getHtmlTags()
    {
        return $this->htmlTags;
    }
    
    /**
     * Sets the value of htmlTags.
     *
     * @param mixed $htmlTags the html tags 
     *
     * @return self
     */
    protected function setHtmlTags($htmlTags)
    {
        $this->htmlTags = $htmlTags;

        return $this;
    }

    /**
     * Gets the value of htmlClass.
     *
     * @return mixed
     */
    public function getHtmlClass()
    {
        return $this->htmlClass;
    }
    
    /**
     * Sets the value of htmlClass.
     *
     * @param mixed $htmlClass the html class 
     *
     * @return self
     */
    protected function setHtmlClass($htmlClass)
    {
        $this->htmlClass = $htmlClass;

        return $this;
    }

    /**
     * Gets the value of htmlAttr.
     *
     * @return mixed
     */
    public function getHtmlAttr()
    {
        return $this->htmlAttr;
    }
    
    /**
     * Sets the value of htmlAttr.
     *
     * @param mixed $htmlAttr the html attr 
     *
     * @return self
     */
    protected function setHtmlAttr($htmlAttr)
    {
        $this->htmlAttr = $htmlAttr;

        return $this;
    }
}