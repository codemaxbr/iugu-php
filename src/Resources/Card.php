<?php

namespace Iugu\Resources;

use Iugu\Base\RequestOptions;
use Iugu\Entity\PaymentMethod;
use Iugu\Entity\PaymentToken;

class Card extends API
{
    public function __construct()
    {
        $this->loadEndpoints();
    }

    public function token(PaymentToken $data)
    {
        $options = new RequestOptions([
            'endpoint' => 'tokenCard',
            'payload' => $data,
        ]);

        return $this->requestHttp($options);
    }

    public function zeroAuth($tokenId)
    {
        $options = new RequestOptions([
            'endpoint' => 'zeroAuth',
            'payload' => ['token' => $tokenId],
        ]);

        return $this->requestHttp($options);
    }

    public function all(string $customerId)
    {
        $options = new RequestOptions([
            'endpoint' => 'getCards',
            'variables' => [$customerId]
        ]);

        return $this->requestHttp($options);
    }

    public function get(string $customerId, string $cardId)
    {
        $options = new RequestOptions([
            'endpoint' => 'getCard',
            'variables' => [$customerId, $cardId]
        ]);

        return $this->requestHttp($options);
    }

    public function create(string $customerId, PaymentMethod $data)
    {
        $options = new RequestOptions([
            'endpoint' => 'createCard',
            'payload' => $data,
            'variables' => [$customerId]
        ]);

        return $this->requestHttp($options);
    }

    public function update(string $customerId, string $cardId, PaymentMethod $data)
    {
        $options = new RequestOptions([
            'endpoint' => 'updateCard',
            'payload' => ['description' => $data->description],
            'variables' => [$customerId, $cardId]
        ]);

        return $this->requestHttp($options);
    }

    public function delete(string $customerId, string $cardId)
    {
        $options = new RequestOptions([
            'endpoint' => 'deleteCard',
            'variables' => [$customerId, $cardId]
        ]);

        return $this->requestHttp($options);
    }

    public function loadEndpoints()
    {
        $this->endpoints = [
            'zeroAuth' => [
                'route' => '/zero_auth',
                'method' => 'POST'
            ],
            'tokenCard' => [
                'route' => '/payment_token',
                'method' => 'POST'
            ],
            'getCards' => [
                'route' => '/customers/:customer_id/payment_methods',
                'method' => 'GET'
            ],
            'getCard' => [
                'route' => '/customers/:customer_id/payment_methods/:id',
                'method' => 'GET'
            ],
            'createCard' => [
                'route' => '/customers/:customer_id/payment_methods',
                'method' => 'POST'
            ],
            'updateCard' => [
                'route' => '/customers/:customer_id/payment_methods/:id',
                'method' => 'PUT'
            ],
            'deleteCard' => [
                'route' => '/customers/:customer_id/payment_methods/:id',
                'method' => 'DELETE'
            ],
        ];
    }
}