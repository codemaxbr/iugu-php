<?php

namespace Codemax;

use Codemax\Resources\Webhook;
use Codemax\Resources\Customer;

/**
 * @method static Customer customer()
 * @method static Webhook webhook()
 */
class Iugu
{
    public static $apiKey;
    public static $environment = 'production';

    public static function setEnviroment($env)
    {
        self::$environment = $env;
    }

    public static function setApiKey($apiKey)
    {
        self::$apiKey = $apiKey;
    }

    public static function __callStatic($method, $args = null)
    {
        $class = '\\Codemax\\Resources\\' . ucfirst($method);
        if (!class_exists($class)) {
            throw new \Exception("Class '{$class}' not found");
        }

        return new $class(self::$apiKey, self::$environment);
    }
}