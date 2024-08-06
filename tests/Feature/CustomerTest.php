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
    public function testGetAllCustomers()
    {
        $result = $this->api->all();
        $this->assertIsArray($result->response->items);
        $this->assertSame(200, $result->statusCode);
    }

    /** @test */
    public function testCreateACustomer()
    {
        $result = $this->api->create($this->customer);
        $this->assertSame(200, $result->statusCode);
        $this->assertObjectHasProperty('id', $result->response);
        $this->assertSame('Cliente Teste', $result->response->name);

        return $result->response->id;
    }

    /**
     * @depends testCreateACustomer
     * @test
     */
    public function testUpdateACustomer(string $id)
    {
        $name = 'Cliente Teste Atualizado';
        $this->customer->setName($name);

        $result = $this->api->update($id, $this->customer);
        $this->assertSame(200, $result->statusCode);
        $this->assertObjectHasProperty('id', $result->response);
        $this->assertSame($name, $result->response->name);
    }

    /**
     * @depends testCreateACustomer
     * @test
     */
    public function testGetACustomer(string $id)
    {
        $result = $this->api->get($id);
        $this->assertSame(200, $result->statusCode);
        $this->assertObjectHasProperty('id', $result->response);
    }

    /**
     * @depends testCreateACustomer
     * @test
     */
    public function testDeleteACustomer(string $id)
    {
        $result = $this->api->delete($id);
        $this->assertSame(200, $result->statusCode);
        $this->assertObjectHasProperty('id', $result->response);
    }
}