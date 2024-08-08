<?php

namespace Codemax\Entity;

class PaymentMethod implements \JsonSerializable
{
    /** @var string $customer_id ID do cliente na Iugu */
    public string $customer_id;

    /** @var string $description Descrição do método de pagamento */
    public string $description;

    /** @var string $token ID Token de pagamento */
    public string $token;

    /** @var boolean $set_as_default Define se o método de pagamento será o padrão */
    public ?bool $set_as_default = false;

    public function setCustomerId(string $customer_id): PaymentMethod
    {
        $this->customer_id = $customer_id;
        return $this;
    }

    public function setDescription(string $description): PaymentMethod
    {
        $this->description = $description;
        return $this;
    }

    public function setToken(string $token): PaymentMethod
    {
        $this->token = $token;
        return $this;
    }

    public function setSetAsDefault(?bool $set_as_default): PaymentMethod
    {
        $this->set_as_default = $set_as_default;
        return $this;
    }

    public function getCustomerId(): string
    {
        return $this->customer_id;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function getSetAsDefault(): ?bool
    {
        return $this->set_as_default;
    }

    public function jsonSerialize()
    {
        return [
            'customer_id' => $this->customer_id,
            'description' => $this->description,
            'token' => $this->token,
            'set_as_default' => $this->set_as_default ?? false,
        ];
    }
}