<?php

namespace Codemax;

use Codemax\Resources\Card;
use Codemax\Resources\Charge;
use Codemax\Resources\Invoice;
use Codemax\Resources\Webhook;
use Codemax\Resources\Customer;

/**
 * @method static Customer customer()
 * @method static Webhook webhook()
 * @method static Charge charge()
 * @method static Card card()
 * @method static Invoice invoice()
 */
class Iugu
{
    public static $apiKey;
    public static $accountId;

    public static function setAccountId($accountId)
    {
        self::$accountId = $accountId;
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

        return new $class(self::$apiKey, self::$accountId);
    }
}