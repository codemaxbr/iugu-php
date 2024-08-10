<?php

namespace Iugu\Tests\Feature;

use Iugu\Base\IntervalType;
use Iugu\Base\PayableWith;
use Iugu\Entity\Plan;
use Iugu\Iugu;
use Iugu\Resources\Plan as API;
use Iugu\Tests\AbstractTestCase;

class PlanTest extends AbstractTestCase
{
    protected API $api;
    protected Plan $plan;

    public function setUp(): void
    {
        parent::setUp();
        Iugu::setApiKey(env('IUGU_PRIVATE_KEY'));
        $this->api = Iugu::plan();

        $this->plan = (new Plan())
            ->setName('Plano Teste')
            ->setIdentifier('plano-teste')
            ->setValueCents(1000)
            ->setInterval(1)
            ->setIntervalType(IntervalType::MONTHS)
            ->setPayableWith([PayableWith::ALL]);
    }

    /** @test */
    public function test_It_should_list_all_plans()
    {
        $result = $this->api->all();
        $this->assertSame(200, $result->statusCode);
        $this->assertIsArray($result->response->items);
    }

    /** @test */
    public function test_It_should_create_a_new_plan()
    {
        $result = $this->api->create($this->plan);
        $this->assertSame(200, $result->statusCode);
        $this->assertObjectHasProperty('id', $result->response);
        $this->assertSame('Plano Teste', $result->response->name);

        return $result->response->id;
    }

    /**
     * @depends test_It_should_create_a_new_plan
     * @test
     */
    public function test_It_should_update_the_data_plan(string $id)
    {
        $name = 'Plano Teste Atualizado';
        $this->plan->setName($name);

        $result = $this->api->update($id, $this->plan);
        $this->assertSame(200, $result->statusCode);
        $this->assertSame($name, $result->response->name);
    }

    /**
     * @depends test_It_should_create_a_new_plan
     * @test
     */
    public function test_It_should_get_a_plan(string $id)
    {
        $result = $this->api->get($id);
        $this->assertSame(200, $result->statusCode);
        $this->assertSame($id, $result->response->id);
    }

    /**
     * @depends test_It_should_create_a_new_plan
     * @test
     */
    public function test_It_should_delete_the_plan(string $id)
    {
        $result = $this->api->delete($id);
        $this->assertSame(200, $result->statusCode);
        $this->assertSame($id, $result->response->id);
    }
}