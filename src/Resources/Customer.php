<?php

namespace Codemax\Resources;

use Codemax\Base\RequestOptions;
use Codemax\Entity\Customer as CustomerAlias;

class Customer extends API
{
    public function __construct()
    {
        $this->loadEndpoints();
    }

    public function all()
    {
        $options = new RequestOptions([
            'endpoint' => 'getCustomers',
        ]);

        return $this->requestHttp($options);
    }

    public function create(CustomerAlias $data)
    {
        $options = new RequestOptions([
            'endpoint' => 'createCustomer',
            'payload' => $data,
        ]);

        return $this->requestHttp($options);
    }

    public function update(string $id, CustomerAlias $data)
    {
        $options = new RequestOptions([
            'endpoint' => 'updateCustomer',
            'payload' => $data,
            'variables' => [$id],
        ]);

        return $this->requestHttp($options);
    }

    public function get(string $id)
    {
        $options = new RequestOptions([
            'endpoint' => 'getCustomer',
            'variables' => [$id],
        ]);

        return $this->requestHttp($options);
    }

    public function delete(string $id)
    {
        $options = new RequestOptions([
            'endpoint' => 'deleteCustomer',
            'variables' => [$id],
        ]);

        return $this->requestHttp($options);
    }

    public function loadEndpoints()
    {
        $this->endpoints = [
            'getCustomer' => [
                'route' => '/customers/:id',
                'method' => 'GET'
            ],
            'getCustomers' => [
                'route' => '/customers',
                'method' => 'GET'
            ],
            'createCustomer' => [
                'route' => '/customers',
                'method' => 'POST'
            ],
            'updateCustomer' => [
                'route' => '/customers/:id',
                'method' => 'PUT'
            ],
            'deleteCustomer' => [
                'route' => '/customers/:id',
                'method' => 'DELETE'
            ],
        ];
    }
}