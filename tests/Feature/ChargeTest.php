<?php

namespace Codemax\Tests\Feature;

use Codemax\Entity\Address;
use Codemax\Entity\Customer;
use Codemax\Entity\Item;
use Codemax\Entity\Payer;
use Codemax\Entity\Payment;
use Codemax\Iugu;
use Codemax\Entity\Charge;
use Codemax\Resources\Charge as API;
use Codemax\Tests\AbstractTestCase;

class ChargeTest extends AbstractTestCase
{
    protected API $api;
    protected Payer $payer;
    protected Item $item;
    protected Customer $customer;
    protected Address $address;

    public function setUp(): void
    {
        parent::setUp();
        Iugu::setApiKey(env('IUGU_PRIVATE_KEY'));
        $this->api = Iugu::charge();

        $this->address = (new Address())
            ->setZipCode('24455400')
            ->setStreet('Rua Ismael do Monte')
            ->setNumber('164')
            ->setDistrict('Mutuapira')
            ->setCity('São Gonçalo')
            ->setState('RJ');

        $this->payer = (new Payer())
            ->setName('Cliente Teste')
            ->setEmail('cliente.teste@gmail.com')
            ->setCpfCnpj('49193961049')
            ->setPhonePrefix('21')
            ->setPhone('999999999')
            ->setAddress($this->address);

        $this->item = (new Item())
            ->setDescription('Produto Teste')
            ->setQuantity(1)
            ->setPriceCents(1000);

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
    public function test_It_should_create_a_new_customer()
    {
        $result = Iugu::customer()->create($this->customer);
        $this->assertSame(200, $result->statusCode);
        $this->assertObjectHasProperty('id', $result->response);
        $this->assertSame('Cliente Teste', $result->response->name);

        return $result->response->id;
    }

    /**
     * @depends test_It_should_create_a_new_customer
     * @test
     */
    public function test_It_should_charge_with_bank_slip($customer_id)
    {
        $data = (new Charge())
            ->setPayer($this->payer)
            ->setCustomerId($customer_id)
            ->setItems([$this->item]);

        $result = $this->api->bank_slip($data);
        $this->assertSame(200, $result->statusCode);
        $this->assertObjectHasProperty('url', $result->response);
    }
}