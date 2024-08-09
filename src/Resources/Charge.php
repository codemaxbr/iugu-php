<?php

namespace Codemax\Resources;

use Codemax\Base\RequestOptions;
use Codemax\Entity\Invoice;
use Codemax\Entity\Payment;

class Charge extends API
{
    public function __construct()
    {
        $this->loadEndpoints();
    }

    public function direct(Payment $payment, $method = 'bank_slip')
    {
        if ($method == 'bank_slip') {
            $payment->setMethod('bank_slip');
        } else {
            unset($payment->method);
        }

        $options = new RequestOptions([
            'endpoint' => 'directCharge',
            'payload' => $payment,
        ]);

        return $this->requestHttp($options);
    }

    public function loadEndpoints()
    {
        $this->endpoints = [
            'directCharge' => [
                'route' => '/charge',
                'method' => 'POST'
            ],
        ];
    }
}