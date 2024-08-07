<?php

namespace Codemax\Entity;

class CreditCard implements \JsonSerializable
{
    /** @var string $number Número do cartão de crédito*/
    public string $number;

    /** @var string $cvv CVV do cartão de crédito */
    public string $cvv;

    /** @var string $holder_name Nome impresso no cartão de crédito */
    public string $holder_name;

    /** @var string $expire_month Mês de vencimento no formato "MM" (Ex: 01, 06, 12) */
    public string $expire_month;

    /** @var string $expire_year Ano de vencimento no formato "YYYY" (Ex: 2021, 2022, 2023) */
    public string $expire_year;

    public function setNumber(string $number): CreditCard
    {
        $this->number = $number;
        return $this;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function setCvv(string $cvv): CreditCard
    {
        $this->cvv = $cvv;
        return $this;
    }

    public function getCvv(): string
    {
        return $this->cvv;
    }

    public function setHolderName(string $holder_name): CreditCard
    {
        $this->holder_name = $holder_name;
        return $this;
    }

    public function getHolderName(): string
    {
        return $this->holder_name;
    }

    public function setExpireMonth(string $expire_month): CreditCard
    {
        $this->expire_month = $expire_month;
        return $this;
    }

    public function getExpireMonth(): string
    {
        return $this->expire_month;
    }

    public function setExpireYear(string $expire_year): CreditCard
    {
        $this->expire_year = $expire_year;
        return $this;
    }

    public function getExpireYear(): string
    {
        return $this->expire_year;
    }

    public function jsonSerialize()
    {
        $holder_name = explode(' ', $this->holder_name);
        return [
            'number' => $this->number,
            'verification_value' => $this->cvv,
            'first_name' => $holder_name[0],
            'last_name' => $holder_name[1] ?? null,
            'month' => $this->expire_month,
            'year' => $this->expire_year,
        ];
    }
}