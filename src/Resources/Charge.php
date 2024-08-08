<?php

namespace Codemax\Resources;

use Codemax\Base\RequestOptions;
use Codemax\Entity\Charge as ChargeAlias;
use Codemax\Entity\PaymentToken;

class Charge extends API
{
    public function __construct()
    {
        $this->loadEndpoints();
    }

    public function direct($data)
    {
        $options = new RequestOptions([
            'endpoint' => 'directCharge',
            'payload' => $data,
        ]);

        return $this->requestHttp($options);
    }

    public function bank_slip(ChargeAlias $charge)
    {
        $charge->setMethod('bank_slip');

        $options = new RequestOptions([
            'endpoint' => 'directCharge',
            'payload' => $charge,
        ]);

        return $this->requestHttp($options);
    }

    public function credit_card(ChargeAlias $charge)
    {
        $charge->setMethod('bank_slip');

        $options = new RequestOptions([
            'endpoint' => 'directCharge',
            'payload' => $charge,
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