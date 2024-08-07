<?php

namespace Codemax\Tests\Feature;

use Codemax\Entity\Customer;
use Codemax\Iugu;
use Codemax\Resources\Customer as API;
use Codemax\Tests\AbstractTestCase;

class CustomerTest extends AbstractTestCase
{
    protected API $api;
    protected Customer $customer;

    public function setUp(): void
    {
        parent::setUp();
        Iugu::setApiKey(env('IUGU_PRIVATE_KEY'));
        $this->api = Iugu::customer();
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
    }

    /** @test */
    public function test_It_should_list_all_customers()
    {
        $result = $this->api->all();
        $this->assertSame(200, $result->statusCode);
        $this->assertIsArray($result->response->items);
    }

    /** @test */
    public function test_It_should_create_a_new_customer()
    {
        $result = $this->api->create($this->customer);
        $this->assertSame(200, $result->statusCode);
        $this->assertObjectHasProperty('id', $result->response);
        $this->assertSame('Cliente Teste', $result->response->name);

        return $result->response->id;
    }

    /**
     * @depends test_It_should_create_a_new_customer
     * @test
     */
    public function test_It_should_update_the_data_customer(string $id)
    {
        $name = 'Cliente Teste Atualizado';
        $this->customer->setName($name);

        $result = $this->api->update($id, $this->customer);
        $this->assertSame(200, $result->statusCode);
        $this->assertObjectHasProperty('id', $result->response);
        $this->assertSame($name, $result->response->name);
    }

    /**
     * @depends test_It_should_create_a_new_customer
     * @test
     */
    public function test_It_should_get_the_data_customer(string $id)
    {
        $result = $this->api->get($id);
        $this->assertSame(200, $result->statusCode);
        $this->assertObjectHasProperty('id', $result->response);
    }

    /**
     * @depends test_It_should_create_a_new_customer
     * @test
     */
    public function test_It_should_delete_the_customer(string $id)
    {
        $result = $this->api->delete($id);
        $this->assertSame(200, $result->statusCode);
        $this->assertObjectHasProperty('id', $result->response);
    }
}