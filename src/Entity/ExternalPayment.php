<?php

namespace Iugu\Entity;

class ExternalPayment implements \JsonSerializable
{
    /** @var string ID externo da fatura (32 caracteres no máx.) */
    protected string $external_payment_id;

    /** @var string|null Justificativa do pagamento (50 caracteres no máx.) */
    protected ?string $external_payment_description;

    public function setExternalPaymentId(string $external_payment_id): ExternalPayment
    {
        $this->external_payment_id = $external_payment_id;
        return $this;
    }

    public function setExternalPaymentDescription(?string $external_payment_description): ExternalPayment
    {
        $this->external_payment_description = $external_payment_description;
        return $this;
    }

    public function getExternalPaymentId(): string
    {
        return $this->external_payment_id;
    }

    public function getExternalPaymentDescription(): ?string
    {
        return $this->external_payment_description;
    }

    public function jsonSerialize()
    {
        return [
            'external_payment_id' => $this->external_payment_id,
            'external_payment_description' => $this->external_payment_description ?? null,
        ];
    }
}