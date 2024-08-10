<?php

namespace Iugu\Resources;

use Iugu\Base\RequestOptions;
use Iugu\Entity\Plan as PlanAlias;

class Plan extends API
{
    public function __construct()
    {
        $this->loadEndpoints();
    }

    public function create(PlanAlias $data)
    {
        $options = new RequestOptions([
            'endpoint' => 'createPlan',
            'payload' => $data,
        ]);

        return $this->requestHttp($options);
    }

    public function all()
    {
        $options = new RequestOptions([
            'endpoint' => 'getPlans',
        ]);

        return $this->requestHttp($options);
    }

    public function get(string $id)
    {
        $options = new RequestOptions([
            'endpoint' => 'getPlan',
            'variables' => [$id],
        ]);

        return $this->requestHttp($options);
    }

    public function update(string $id, PlanAlias $data)
    {
        $options = new RequestOptions([
            'endpoint' => 'updatePlan',
            'payload' => $data,
            'variables' => [$id],
        ]);

        return $this->requestHttp($options);
    }

    public function delete(string $id)
    {
        $options = new RequestOptions([
            'endpoint' => 'deletePlan',
            'variables' => [$id],
        ]);

        return $this->requestHttp($options);
    }

    public function loadEndpoints()
    {
        $this->endpoints = [
            'createPlan' => [
                'route' => '/plans',
                'method' => 'POST'
            ],
            'getPlans' => [
                'route' => '/plans',
                'method' => 'GET'
            ],
            'getPlan' => [
                'route' => '/plans/:id',
                'method' => 'GET'
            ],
            'updatePlan' => [
                'route' => '/plans/:id',
                'method' => 'PUT'
            ],
            'deletePlan' => [
                'route' => '/plans/:id',
                'method' => 'DELETE'
            ]
        ];
    }
}