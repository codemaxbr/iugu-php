<?php

namespace Iugu;

use Iugu\Resources\Card;
use Iugu\Resources\Charge;
use Iugu\Resources\Invoice;
use Iugu\Resources\Plan;
use Iugu\Resources\Subscription;
use Iugu\Resources\Webhook;
use Iugu\Resources\Customer;

/**
 * @method static Customer customer()
 * @method static Webhook webhook()
 * @method static Charge charge()
 * @method static Card card()
 * @method static Invoice invoice()
 * @method static Plan plan()
 * @method static Subscription subscription()
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
        $class = '\\Iugu\\Resources\\' . ucfirst($method);
        if (!class_exists($class)) {
            throw new \Exception("Class '{$class}' not found");
        }

        return new $class(self::$apiKey, self::$accountId);
    }
}