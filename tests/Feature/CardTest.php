<?php

namespace Codemax\Tests\Feature;

use Codemax\Base\IuguWebhookEvent;
use Codemax\Entity\CreditCard;
use Codemax\Entity\Customer;
use Codemax\Entity\PaymentMethod;
use Codemax\Entity\PaymentToken;
use Codemax\Iugu;
use Codemax\Resources\Card as API;
use Codemax\Tests\AbstractTestCase;

class CardTest extends AbstractTestCase
{
    protected API $api;
    protected PaymentMethod $paymentMethod;
    protected PaymentToken $token;
    protected CreditCard $card;
    protected Customer $customer;

    public function setUp(): void
    {
        parent::setUp();
        Iugu::setApiKey(env('IUGU_PRIVATE_KEY'));
        $this->api = Iugu::card();

        $this->customer = (new Customer())
            ->setName('Cliente Teste')
            ->setEmail('cliente.teste@gmail.com')
            ->setCpfCnpj('49193961049')
            ->setZipCode('24455400')
            ->setStreet('Rua Ismael do Monte')
            ->setNumber('164')
            ->setDistrict('Mutuapira')
            ->setCity('São Gonçalo')
            ->setState('RJ');

        $this->card = (new CreditCard())
            ->setNumber('4111111111111111')
            ->setCvv('123')
            ->setFirstName('Lucas Maia')
            ->setLastName('de Paula')
            ->setExpireMonth('03')
            ->setExpireYear('2030');

        $this->token = (new PaymentToken())
            ->setAccountId(env('IUGU_ACCOUNT_ID'))
            ->setTest(true)
            ->setData($this->card);
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
    public function test_It_should_tokenize_the_card_of_the_customer()
    {
        $result = $this->api->token($this->token);
        $this->assertSame(200, $result->statusCode);
        $this->assertObjectHasProperty('id', $result->response);
        return $result->response->id;
    }

    /**
     * @depends test_It_should_create_a_new_customer
     */
    public function test_It_should_list_all_payment_methods_that_the_customer_has($customer_id)
    {
        $result = $this->api->all($customer_id);
        $this->assertSame(200, $result->statusCode);
        $this->assertIsArray($result->response);
    }

    ///**
    // * @depends test_It_should_tokenize_the_card_of_the_customer
    // * @test
    // */
    //public function test_It_should_verifies_the_card_with_zero_auth($token_id)
    //{
    //    $result = $this->api->zeroAuth($token_id);
    //    $this->assertSame(200, $result->statusCode);
    //}

    /**
     * @depends test_It_should_create_a_new_customer
     * @depends test_It_should_tokenize_the_card_of_the_customer
     * @test
     */
    public function test_It_should_create_a_payment_method_for_the_customer($customer_id, $token_id)
    {
        $payment_method = (new PaymentMethod())
            ->setCustomerId($customer_id)
            ->setDescription('Cartão teste')
            ->setToken($token_id)
            ->setSetAsDefault(false);

        $result = $this->api->create($customer_id, $payment_method);
        $this->assertSame(200, $result->statusCode);
        $this->assertObjectHasProperty('id', $result->response);

        return $result->response->id;
    }

    /**
     * @depends test_It_should_create_a_new_customer
     * @depends test_It_should_create_a_payment_method_for_the_customer
     * @test
     */
    public function test_It_should_get_the_payment_method_of_the_customer($customer_id, $payment_method_id)
    {
        $result = $this->api->get($customer_id, $payment_method_id);
        $this->assertSame(200, $result->statusCode);
        $this->assertObjectHasProperty('id', $result->response);
    }

    /**
     * @depends test_It_should_create_a_new_customer
     * @depends test_It_should_create_a_payment_method_for_the_customer
     * @test
     */
    public function test_It_should_update_the_payment_method_of_the_customer($customer_id, $payment_method_id)
    {
        $payment_method = (new PaymentMethod())
            ->setCustomerId($customer_id)
            ->setDescription('Cartão teste atualizado')
            ->setSetAsDefault(true);

        $result = $this->api->update($customer_id, $payment_method_id, $payment_method);
        $this->assertSame(200, $result->statusCode);
        $this->assertObjectHasProperty('id', $result->response);
    }

    /**
     * @depends test_It_should_create_a_new_customer
     * @depends test_It_should_create_a_payment_method_for_the_customer
     * @test
     */
    public function test_It_should_delete_the_payment_method_of_the_customer($customer_id, $payment_method_id)
    {
        $result = $this->api->delete($customer_id, $payment_method_id);
        $this->assertSame(200, $result->statusCode);
        $this->assertObjectHasProperty('id', $result->response);
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
}