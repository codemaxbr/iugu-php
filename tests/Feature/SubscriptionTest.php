<?php

namespace Iugu\Tests\Feature;

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
            ->setEmail('kawibe9729@mvpalace.com');

        $this->plan = (new Plan())
            ->setName('Plano Teste')
            ->setIdentifier('plano-teste')
            ->setValueCents(1000)
            ->setInterval(1)
            ->setIntervalType(IntervalType::MONTHS)
            ->setPayableWith([PayableWith::ALL]);
    }
}