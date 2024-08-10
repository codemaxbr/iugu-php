<?php

namespace Iugu\Entity;

class Webhook implements \JsonSerializable
{
    /** @var string $event Nome do evento que deseja receber notificações */
    public string $event;

    /** @var string $url Endpoint para qual o Webhook será enviado */
    public string $url;

    /** @var string|null $authorization_token Token de autorização para o Webhook */
    public ?string $authorization_token;

    public function getEvent(): string
    {
        return $this->event;
    }

    public function setEvent(string $event): Webhook
    {
        $this->event = $event;
        return $this;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): Webhook
    {
        $this->url = $url;
        return $this;
    }

    public function setAuthorizationToken(?string $authorization_token): Webhook
    {
        $this->authorization_token = $authorization_token;
        return $this;
    }

    public function getAuthorizationToken(): ?string
    {
        return $this->authorization_token;
    }

    public function jsonSerialize()
    {
        return [
            'event' => $this->event,
            'url' => $this->url,
            'authorization_token' => $this->authorization_token ?? null
        ];
    }
}