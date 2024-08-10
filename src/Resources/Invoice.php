<?php

namespace Iugu\Resources;

use Iugu\Base\RequestOptions;
use Iugu\Entity\ExternalPayment;
use Iugu\Entity\Invoice as Entity;
use Iugu\Entity\Payment;

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

    public function refund($invoice_id)
    {
        $options = new RequestOptions([
            'endpoint' => 'refundInvoice',
            'variables' => [$invoice_id],
        ]);

        return $this->requestHttp($options);
    }

    public function cancel($invoice_id)
    {
        $options = new RequestOptions([
            'endpoint' => 'cancelInvoice',
            'variables' => [$invoice_id],
        ]);

        return $this->requestHttp($options);
    }

    public function make_paid($invoice_id, ExternalPayment $external_payment)
    {
        $options = new RequestOptions([
            'endpoint' => 'makePaidInvoice',
            'variables' => [$invoice_id],
            'payload' => $external_payment,
        ]);

        return $this->requestHttp($options);
    }

    public function get($invoice_id)
    {
        $options = new RequestOptions([
            'endpoint' => 'getInvoice',
            'variables' => [$invoice_id],
        ]);

        return $this->requestHttp($options);
    }

    public function all()
    {
        $options = new RequestOptions([
            'endpoint' => 'getInvoices',
        ]);

        return $this->requestHttp($options);
    }

    public function loadEndpoints()
    {
        $this->endpoints = [
            'getInvoices' => [
                'route' => '/invoices',
                'method' => 'GET'
            ],
            'getInvoice' => [
                'route' => '/invoices/:id',
                'method' => 'GET'
            ],
            'createInvoice' => [
                'route' => '/invoices',
                'method' => 'POST'
            ],
            'refundInvoice' => [
                'route' => '/invoices/:id/refund',
                'method' => 'POST'
            ],
            'cancelInvoice' => [
                'route' => '/invoices/:id/cancel',
                'method' => 'PUT'
            ],
            'makePaidInvoice' => [
                'route' => '/invoices/:id/externally_pay',
                'method' => 'PUT'
            ],
        ];
    }
}