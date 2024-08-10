<?php

namespace Iugu\Resources;

use Iugu\Base\RequestOptions;
use Iugu\Entity\Subscription as SubscriptionAlias;

class Subscription extends API
{
    public function __construct()
    {
        $this->loadEndpoints();
    }

    public function create(SubscriptionAlias $data)
    {
        $options = new RequestOptions([
            'endpoint' => 'createSubscription',
            'payload' => $data,
        ]);

        return $this->requestHttp($options);
    }

    public function all()
    {
        $options = new RequestOptions([
            'endpoint' => 'getSubscriptions',
        ]);

        return $this->requestHttp($options);
    }

    public function get(string $id)
    {
        $options = new RequestOptions([
            'endpoint' => 'getSubscription',
            'variables' => [$id],
        ]);

        return $this->requestHttp($options);
    }

    public function update(string $id, SubscriptionAlias $data)
    {
        $options = new RequestOptions([
            'endpoint' => 'updateSubscription',
            'payload' => $data,
            'variables' => [$id],
        ]);

        return $this->requestHttp($options);
    }

    public function delete(string $id)
    {
        $options = new RequestOptions([
            'endpoint' => 'deleteSubscription',
            'variables' => [$id],
        ]);

        return $this->requestHttp($options);
    }

    public function loadEndpoints()
    {
        $this->endpoints = [
            'createSubscription' => [
                'route' => '/subscriptions',
                'method' => 'POST'
            ],
            'getSubscriptions' => [
                'route' => '/subscriptions',
                'method' => 'GET'
            ],
            'getSubscription' => [
                'route' => '/subscriptions/:id',
                'method' => 'GET'
            ],
            'updateSubscription' => [
                'route' => '/subscriptions/:id',
                'method' => 'PUT'
            ],
            'deleteSubscription' => [
                'route' => '/subscriptions/:id',
                'method' => 'DELETE'
            ]
        ];
    }
}