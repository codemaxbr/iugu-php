<?php

namespace Codemax\Tests\Feature;

use Codemax\Base\IuguWebhookEvent;
use Codemax\Entity\Webhook;
use Codemax\Iugu;
use Codemax\Resources\Webhook as API;
use Codemax\Tests\AbstractTestCase;

class WebhookTest extends AbstractTestCase
{
    protected API $api;
    protected Webhook $webhook;

    public function setUp(): void
    {
        parent::setUp();
        Iugu::setApiKey(env('IUGU_PRIVATE_KEY'));
        $this->api = Iugu::webhook();
        $this->webhook = (new Webhook())
            ->setEvent(IuguWebhookEvent::INVOICE_STATUS_CHANGED)
            ->setUrl('https://webhook.site/645aafbb-5fdc-4429-a9e7-1eabf564cf90');
    }

    /** @test */
    public function testGetAllWebhooks()
    {
        $result = $this->api->all();
        $this->assertIsArray($result->response);
        $this->assertSame(200, $result->statusCode);
    }

    /** @test */
    public function testCreateAWebhook()
    {
        $result = $this->api->create($this->webhook);
        $this->assertSame(200, $result->statusCode);
        $this->assertObjectHasProperty('id', $result->response);
        $this->assertSame(IuguWebhookEvent::INVOICE_STATUS_CHANGED, $result->response->event);

        return $result->response->id;
    }

    /**
     * @depends testCreateAWebhook
     * @test
     */
    public function testUpdateAWebhook(string $id)
    {
        $event = IuguWebhookEvent::ALL;
        $this->webhook->setEvent($event);

        $result = $this->api->update($id, $this->webhook);
        $this->assertSame(200, $result->statusCode);
        $this->assertObjectHasProperty('id', $result->response);
        $this->assertSame($event, $result->response->event);
    }

    /**
     * @depends testCreateAWebhook
     * @test
     */
    public function testGetAWebhook(string $id)
    {
        $result = $this->api->get($id);
        $this->assertSame(200, $result->statusCode);
        $this->assertObjectHasProperty('id', $result->response);
    }

    /**
     * @depends testCreateAWebhook
     * @test
     */
    public function testChangeStatusAWebhook(string $id)
    {
        $result = $this->api->status($id);
        $this->assertSame(200, $result->statusCode);
        $this->assertObjectHasProperty('id', $result->response);
    }

    /**
     * @depends testCreateAWebhook
     * @test
     */
    public function testDeleteAWebhook(string $id)
    {
        $result = $this->api->delete($id);
        $this->assertSame(200, $result->statusCode);
        $this->assertObjectHasProperty('id', $result->response);
    }
}