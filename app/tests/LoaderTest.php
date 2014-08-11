<?php

class LoaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException InvalidArgumentException
     */
    public function testThrowExceptionWhenParameterIsNull()
    {
        // $loader = new \DevMediaLab\Proxy\Loader;
        // $loader->load(null);
    }

}