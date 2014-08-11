<?php

/*
|--------------------------------------------------------------------------
| FROM LARAVEL FRAMEWORK Set PHP Error Reporting Options
|--------------------------------------------------------------------------
*/

// error_reporting(-1);

/*
|--------------------------------------------------------------------------
| FROM LARAVEL FRAMEWORK Check Extensions
|--------------------------------------------------------------------------
*/

if ( ! extension_loaded('mcrypt'))
{
    echo 'Mcrypt PHP extension required.'.PHP_EOL;

    exit(1);
}

/**
 * Require routes.php
 */
require $system['paths']['appPath'].'/routes.php';

/**
 * Handle the request.environment 
 */
$system->handleHttp($system['request.environment']);


/**
 * return the System instance
 */
return $system;