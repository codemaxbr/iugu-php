<?php

namespace Iugu\Tests\Feature;

use Iugu\Entity\Address;
use Iugu\Entity\CreditCard;
use Iugu\Entity\Customer;
use Iugu\Entity\CustomVariable;
use Iugu\Entity\ExternalPayment;
use Iugu\Entity\Invoice;
use Iugu\Entity\Item;
use Iugu\Entity\Payer;
use Iugu\Entity\Payment;
use Iugu\Entity\PaymentToken;
use Iugu\Iugu;
use Iugu\Resources\Invoice as API;
use Iugu\Tests\AbstractTestCase;

class InvoiceTest extends AbstractTestCase
{
    protected API $api;
    protected Payer $payer;
    protected Item $item;
    protected Customer $customer;
    protected Address $address;
    protected Invoice $invoice;

    public function setUp(): void
    {
        parent::setUp();
        Iugu::setApiKey(env('IUGU_PRIVATE_KEY'));
        $this->api = Iugu::invoice();

        $this->address = (new Address())
            ->setZipCode('24455400')
            ->setStreet('Rua Ismael do Monte')
            ->setNumber('164')
            ->setDistrict('Mutuapira')
            ->setCity('São Gonçalo')
            ->setState('RJ');

        $this->payer = (new Payer())
            ->setName('Cliente Teste')
            ->setEmail('kawibe9729@mvpalace.com')
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
            ->setEmail('kawibe9729@mvpalace.com')
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
            ->setFirstName('Cliente Teste')
            ->setLastName('da Silva')
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
        $result = Iugu::card()->token($this->token);
        $this->assertSame(200, $result->statusCode);
        $this->assertObjectHasProperty('id', $result->response);
        return $result->response->id;
    }

    /** @test */
    public function test_It_should_list_all_invoices()
    {
        $result = $this->api->all();
        $this->assertSame(200, $result->statusCode);
        $this->assertObjectHasProperty('items', $result->response);
        $this->assertIsArray($result->response->items);
    }

    /**
     * @depends test_It_should_create_a_new_customer
     * @test
     */
    public function test_It_should_create_an_invoice_for_a_customer($customer_id)
    {
        $data = (new Invoice())
            ->setPayer($this->payer)
            ->setEmail($this->payer->getEmail())
            ->setCustomerId($customer_id)
            ->setNotificationUrl('https://webhook.site/c80eb229-af0b-4ff9-8e2a-94c5637f0a69')
            ->setItems([$this->item]);

        $result = $this->api->create($data);
        $this->assertSame(200, $result->statusCode);
        $this->assertObjectHasProperty('id', $result->response);
        $this->assertObjectHasProperty('qrcode', $result->response->pix);
        $this->assertObjectHasProperty('bank_slip_pdf_url', $result->response->bank_slip);

        return $result->response->id;
    }

    /**
     * @depends test_It_should_create_an_invoice_for_a_customer
     * @test
     */
    public function test_It_should_be_show_details_of_than_invoice($invoice_id)
    {
        $result = $this->api->get($invoice_id);
        $this->assertSame(200, $result->statusCode);
        $this->assertObjectHasProperty('id', $result->response);
        $this->assertSame($invoice_id, $result->response->id);
    }

    /**
     * @depends test_It_should_create_a_new_customer
     * @test
     */
    public function test_It_should_charge_detached_with_bank_slip($customer_id)
    {
        $data = (new Payment())
            ->setPayer($this->payer)
            ->setCustomerId($customer_id)
            ->setItems([$this->item]);

        $result = Iugu::charge()->direct($data);
        $this->assertSame(200, $result->statusCode);
        $this->assertObjectHasProperty('url', $result->response);
        $this->assertObjectHasProperty('invoice_id', $result->response);

        return $result->response->invoice_id;
    }

    /**
     * @depends test_It_should_charge_detached_with_bank_slip
     * @test
     */
    public function test_It_should_make_paid_an_invoice($invoice_id)
    {
        $data = (new ExternalPayment())
            ->setExternalPaymentId('123456')
            ->setExternalPaymentDescription('Pagamento via maquininha');

        $result = $this->api->make_paid($invoice_id, $data);
        $this->assertSame(200, $result->statusCode);
        $this->assertObjectHasProperty('id', $result->response);
        $this->assertSame('externally_paid', $result->response->status);
    }

    /**
     * @depends test_It_should_create_a_new_customer
     * @depends test_It_should_create_an_invoice_for_a_customer
     * @test
     */
    public function test_It_should_charge_an_invoice_with_bank_slip($customer_id, $invoice_id)
    {
        $data = (new Payment())
            ->setPayer($this->payer)
            ->setCustomerId($customer_id)
            ->setInvoiceId($invoice_id);

        $result = Iugu::charge()->direct($data);
        $this->assertSame(200, $result->statusCode);
        $this->assertObjectHasProperty('url', $result->response);
        $this->assertObjectHasProperty('invoice_id', $result->response);
    }

    /**
     * @depends test_It_should_create_a_new_customer
     * @depends test_It_should_tokenize_the_card_of_the_customer
     * @depends test_It_should_create_an_invoice_for_a_customer
     * @test
     */
    public function test_It_should_charge_an_invoice_with_credit_card($customer_id, $token_id, $invoice_id)
    {
        $data = (new Payment())
            ->setPayer($this->payer)
            ->setCustomerId($customer_id)
            ->setInvoiceId($invoice_id)
            ->setToken($token_id);

        $result = Iugu::charge()->direct($data, 'credit_card');
        $this->assertSame(200, $result->statusCode);
        $this->assertSame('captured', $result->response->status);
        $this->assertObjectHasProperty('invoice_id', $result->response);
    }

    /**
     * @depends test_It_should_create_an_invoice_for_a_customer
     * @test
     */
    public function test_It_should_refund_the_amount_charge_of_than_invoice($invoice_id)
    {
        $result = $this->api->refund($invoice_id);
        $this->assertSame(200, $result->statusCode);
        $this->assertObjectHasProperty('id', $result->response);
        $this->assertSame('refunded', $result->response->status);
    }

    /**
     * @depends test_It_should_create_an_invoice_for_a_customer
     * @test
     */
    public function test_It_should_cancel_an_invoice($invoice_id)
    {
        $result = $this->api->cancel($invoice_id);
        $this->assertTrue(200 || 400, $result->statusCode); // 400 if the invoice is already refunded | paid | canceled
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