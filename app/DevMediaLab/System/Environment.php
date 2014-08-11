<?php
namespace DevMediaLab\System; 


/**
 * This class creates and returns a key/value array of common
 * environment variables for the current HTTP request.
 *
 * This is a singleton class
*/

class Environment implements \ArrayAccess, \IteratorAggregate
{
    
    protected static $special = [
        'CONTENT_TYPE',
        'CONTENT_LENGTH',
        'PHP_AUTH_USER',
        'PHP_AUTH_PW',
        'PHP_AUTH_DIGEST',
        'AUTH_TYPE'
    ];


    protected static $environment;

    public static function getInstance($refresh = false)
    {
        if (is_null(static::$environment) || $refresh) {
            static::$environment = new static();
        }

        return static::$environment;
    }

    /**
    * Get mock environment instance
    *
    * @param array $userSettings
    * @return \Slim\Environment
    */
        public static function mock($userSettings = array())
        {
            $defaults = array(
                'REQUEST_METHOD' => 'GET',
                'SCRIPT_NAME' => '',
                'PATH_INFO' => '',
                'QUERY_STRING' => '',
                'SERVER_NAME' => 'localhost',
                'SERVER_PORT' => 80,
                'ACCEPT' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                'ACCEPT_LANGUAGE' => 'en-US,en;q=0.8',
                'ACCEPT_CHARSET' => 'ISO-8859-1,utf-8;q=0.7,*;q=0.3',
                'USER_AGENT' => 'Slim Framework',
                'REMOTE_ADDR' => '127.0.0.1',
                'slim.url_scheme' => 'http',
                'slim.input' => '',
                'slim.errors' => @fopen('php://stderr', 'w')
            );
            static::$environment = new static(array_merge($defaults, $userSettings));

            return static::$environment;
        }

        /**
    * Constructor (private access)
    *
    * @param array|null $settings If present, these are used instead of global server variables
    */
    private function __construct($settings = null)
    {
        if ($settings) {
            $this->properties = $settings;
        } else {
            $env = [];

            //The HTTP request method
            $env['REQUEST_METHOD'] = $_SERVER['REQUEST_METHOD'];

            //The IP
            $env['REMOTE_ADDR'] = $_SERVER['REMOTE_ADDR'];

            // Server params
            $scriptName = $_SERVER['SCRIPT_NAME'];
            $requestUri = $_SERVER['REQUEST_URI'];
            $queryString = isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : '';
            // Physical path
            if (strpos($requestUri, $scriptName) !== false) {
                $physicalPath = $scriptName; // <-- Without rewriting
            } else {
                $physicalPath = str_replace('\\', '', dirname($scriptName)); // <-- With rewriting
            }
            $env['SCRIPT_NAME'] = rtrim($physicalPath, '/'); // <-- Remove trailing slashes

            // Virtual path
            $env['PATH_INFO'] = substr_replace($requestUri, '', 0, strlen($physicalPath)); // <-- Remove physical path
            $env['PATH_INFO'] = str_replace('?' . $queryString, '', $env['PATH_INFO']); // <-- Remove query string
            $env['PATH_INFO'] = '/' . ltrim($env['PATH_INFO'], '/'); // <-- Ensure leading slash

            // Query string (without leading "?")
            $env['QUERY_STRING'] = $queryString;

            //Name of server host that is running the script
            $env['SERVER_NAME'] = $_SERVER['SERVER_NAME'];

            //Number of server port that is running the script
            $env['SERVER_PORT'] = $_SERVER['SERVER_PORT'];

            //HTTP request headers (retains HTTP_ prefix to match $_SERVER)
            $headers = static::extract($_SERVER);
            foreach ($headers as $key => $value) {
                $env[$key] = $value;
            }

            //Is the application running under HTTPS or HTTP protocol?
            $env['slim.url_scheme'] = empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off' ? 'http' : 'https';

            //Input stream (readable one time only; not available for multipart/form-data requests)
            $rawInput = @file_get_contents('php://input');
            if (!$rawInput) {
                $rawInput = '';
            }
            $env['slim.input'] = $rawInput;

            //Error stream
            $env['slim.errors'] = @fopen('php://stderr', 'w');

            $this->properties = $env;
        }
    }

    public static function extract($data)
    {
        $results = array();
        foreach ($data as $key => $value) {
            $key = strtoupper($key);
            if (strpos($key, 'X_') === 0 || strpos($key, 'HTTP_') === 0 || in_array($key, static::$special)) {
                if ($key === 'HTTP_CONTENT_LENGTH') {
                    continue;
                }
                $results[$key] = $value;
            }
        }

        return $results;
    }



    /**
    * Array Access: Offset Exists
    */
    public function offsetExists($offset)
    {
        return isset($this->properties[$offset]);
    }

    /**
    * Array Access: Offset Get
    */
    public function offsetGet($offset)
    {
        if (isset($this->properties[$offset])) {
            return $this->properties[$offset];
        } else {
            return null;
        }
    }

    /**
    * Array Access: Offset Set
    */
    public function offsetSet($offset, $value)
    {
        $this->properties[$offset] = $value;
    }

    /**
    * Array Access: Offset Unset
    */
    public function offsetUnset($offset)
    {
        unset($this->properties[$offset]);
    }

    /**
    * IteratorAggregate
    *
    * @return \ArrayIterator
    */
    public function getIterator()
    {
        return new \ArrayIterator($this->properties);
    }
}