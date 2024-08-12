<?php

namespace Iugu\Tests\Feature;

use Carbon\Carbon;
use Iugu\Base\IntervalType;
use Iugu\Base\PayableWith;
use Iugu\Entity\Customer;
use Iugu\Entity\Plan;
use Iugu\Entity\Subscription;
use Iugu\Iugu;
use Iugu\Tests\AbstractTestCase;

class SubscriptionTest extends AbstractTestCase
{
    protected Customer $customer;
    protected Plan $plan;
    protected Subscription $subscription;

    public function setUp(): void
    {
        parent::setUp();
        Iugu::setApiKey(env('IUGU_PRIVATE_KEY'));
        $this->api = Iugu::subscription();

        $this->customer = (new Customer())
            ->setName('Cliente Teste')
            ->setCpfCnpj('49193961049')
            ->setEmail('kawibe9729@mvpalace.com');

        $this->plan = (new Plan())
            ->setName('Teste plano')
            ->setIdentifier('teste-plano')
            ->setValueCents(1000)
            ->setInterval(1)
            ->setIntervalType(IntervalType::MONTHS)
            ->setPayableWith([PayableWith::ALL]);
    }

    /** @test */
    public function test_It_should_list_all_subscriptions()
    {
        $result = $this->api->all();
        $this->assertSame(200, $result->statusCode);
        $this->assertIsArray($result->response->items);
    }

    /** @test */
    public function test_It_should_create_a_new_customer()
    {
        $result = Iugu::customer()->create($this->customer);
        $this->assertSame(200, $result->statusCode);
        $this->assertObjectHasProperty('id', $result->response);
        $this->assertSame('Cliente Teste', $result->response->name);

        return $result->response->id;
    }

    /** @test */
    public function test_It_should_create_a_new_plan()
    {
        $result = Iugu::plan()->create($this->plan);
        $this->assertSame(200, $result->statusCode);
        $this->assertObjectHasProperty('id', $result->response);

        return $result->response->id;
    }

    /**
     * @depends test_It_should_create_a_new_customer
     * @test
     */
    public function test_It_should_create_a_new_subscription($customer_id)
    {
        $this->subscription = (new Subscription())
            ->setCustomerId($customer_id)
            ->setPlanIdentifier($this->plan->identifier)
            ->setOnlyOnChargeSuccess(false);

        $result = $this->api->create($this->subscription);
        $this->assertSame(200, $result->statusCode);
        $this->assertObjectHasProperty('id', $result->response);

        return $result->response->id;
    }

    /**
     * @depends test_It_should_create_a_new_subscription
     * @depends test_It_should_create_a_new_customer
     * @test
     */
    public function test_It_should_update_the_subscription(string $id, $customer_id)
    {
        $this->subscription = (new Subscription())
            ->setExpiresAt(Carbon::now()->addMonths(1))
            ->setPriceCents($this->plan->value_cents)
            ->setCustomerId($customer_id)
            ->setOnlyOnChargeSuccess(false);

        $result = $this->api->update($id, $this->subscription);
        $this->assertSame(200, $result->statusCode);
        $this->assertSame($id, $result->response->id);
    }

    /**
     * @depends test_It_should_create_a_new_subscription
     * @test
     */
    public function test_It_should_get_the_subscription(string $id)
    {
        $result = $this->api->get($id);
        $this->assertSame(200, $result->statusCode);
        $this->assertSame($id, $result->response->id);
    }

    /**
     * @depends test_It_should_create_a_new_subscription
     * @test
     */
    public function test_It_should_suspend_the_subscription(string $id)
    {
        $result = $this->api->suspend($id);
        $this->assertSame(200, $result->statusCode);
        $this->assertSame($id, $result->response->id);
    }

    /**
     * @depends test_It_should_create_a_new_subscription
     * @test
     */
    public function test_It_should_activate_the_subscription(string $id)
    {
        $result = $this->api->activate($id);
        $this->assertSame(200, $result->statusCode);
        $this->assertSame($id, $result->response->id);
    }

    /**
     * @depends test_It_should_create_a_new_subscription
     * @test
     */
    public function test_It_should_remove_the_subscription(string $id)
    {
        $result = $this->api->delete($id);
        $this->assertSame(200, $result->statusCode);
        $this->assertSame($id, $result->response->id);
    }

    /**
     * @depends test_It_should_create_a_new_customer
     * @test
     */
    public function test_It_should_delete_the_customer(string $id)
    {
        $result = Iugu::customer()->delete($id);
        $this->assertSame(200, $result->statusCode);
        $this->assertObjectHasProperty('id', $result->response);
    }

    /**
     * @depends test_It_should_create_a_new_plan
     * @test
     */
    public function test_It_should_delete_the_plan(string $id)
    {
        $result = Iugu::plan()->delete($id);
        $this->assertSame(200, $result->statusCode);
        $this->assertSame($id, $result->response->id);
    }
}