<?php
require_once './vendor/autoload.php';

use Codemax\Iugu;

Iugu::setEnviroment('sandbox');
Iugu::setApiKey('A2356E05CB20C0625B95E2ED054CDBC42988F09E2AE50102FA61E658E5C13B68');

try {
    $customers = Iugu::customer()->all();
    dd($customers);
} catch (\Exception $e) {
    dd($e);
}