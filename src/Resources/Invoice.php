<?php

namespace Codemax\Resources;

use Codemax\Base\RequestOptions;
use Codemax\Entity\Invoice as Entity;
use Codemax\Entity\Payment;

class Invoice extends API
{
    public function __construct()
    {
        $this->loadEndpoints();
    }

    public function create(Entity $invoice)
    {
        $options = new RequestOptions([
            'endpoint' => 'createInvoice',
            'payload' => $invoice,
        ]);

        return $this->requestHttp($options);
    }

    public function loadEndpoints()
    {
        $this->endpoints = [
            'createInvoice' => [
                'route' => '/invoices',
                'method' => 'POST'
            ],
        ];
    }
}