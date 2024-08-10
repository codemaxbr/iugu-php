<?php

namespace Iugu\Resources;

use Iugu\Base\RequestOptions;
use Iugu\Entity\Webhook as WebhookAlias;

class Webhook extends API
{
    public function __construct()
    {
        $this->loadEndpoints();
    }

    public function all()
    {
        $options = new RequestOptions([
            'endpoint' => 'getWebhooks',
        ]);

        return $this->requestHttp($options);
    }

    public function create(WebhookAlias $data)
    {
        $options = new RequestOptions([
            'endpoint' => 'createWebhook',
            'payload' => $data,
        ]);

        return $this->requestHttp($options);
    }

    public function update(string $id, WebhookAlias $data)
    {
        $options = new RequestOptions([
            'endpoint' => 'updateWebhook',
            'payload' => $data,
            'variables' => [$id],
        ]);

        return $this->requestHttp($options);
    }

    public function get(string $id)
    {
        $options = new RequestOptions([
            'endpoint' => 'getWebhook',
            'variables' => [$id],
        ]);

        return $this->requestHttp($options);
    }

    public function delete(string $id)
    {
        $options = new RequestOptions([
            'endpoint' => 'deleteWebhook',
            'variables' => [$id],
        ]);

        return $this->requestHttp($options);
    }

    public function status(string $id)
    {
        $options = new RequestOptions([
            'endpoint' => 'statusWebhook',
            'variables' => [$id],
        ]);

        return $this->requestHttp($options);
    }

    public function loadEndpoints()
    {
        $this->endpoints = [
            'getWebhook' => [
                'route' => '/web_hooks/:id',
                'method' => 'GET'
            ],
            'statusWebhook' => [
                'route' => '/web_hooks/:id/toggle_activation',
                'method' => 'PUT'
            ],
            'getWebhooks' => [
                'route' => '/web_hooks',
                'method' => 'GET'
            ],
            'createWebhook' => [
                'route' => '/web_hooks',
                'method' => 'POST'
            ],
            'updateWebhook' => [
                'route' => '/web_hooks/:id',
                'method' => 'PUT'
            ],
            'deleteWebhook' => [
                'route' => '/web_hooks/:id',
                'method' => 'DELETE'
            ],
        ];
    }
}