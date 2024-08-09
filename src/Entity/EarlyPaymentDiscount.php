<?php

namespace Codemax\Entity;

class EarlyPaymentDiscount implements \JsonSerializable
{
    /** @var int|null $days Número de dias antes do vencimento para aplicação do desconto. */
    protected ?int $days;

    /** @var float|null $percent Valor do desconto em porcentagem. Não pode ser usado com value_cents. */
    protected ?float $percent;

    /** @var int|null $value_cents Valor do desconto em centavos. Não pode ser usado com percent. */
    protected ?int $value_cents;

    public function getDays(): ?int
    {
        return $this->days;
    }

    public function setDays(?int $days): EarlyPaymentDiscount
    {
        $this->days = $days;
        return $this;
    }

    public function getPercent(): ?float
    {
        return $this->percent;
    }

    public function setPercent(?float $percent): EarlyPaymentDiscount
    {
        $this->percent = $percent;
        return $this;
    }

    public function getValueCents(): ?int
    {
        return $this->value_cents;
    }

    public function setValueCents(?int $value_cents): EarlyPaymentDiscount
    {
        $this->value_cents = $value_cents;
        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'days' => $this->days,
            'percent' => $this->percent,
            'value_cents' => $this->value_cents,
        ];
    }
}