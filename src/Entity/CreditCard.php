<?php

namespace Codemax\Entity;

class CreditCard implements \JsonSerializable
{
    /** @var string $number Número do cartão de crédito*/
    public string $number;

    /** @var string $cvv CVV do cartão de crédito */
    public string $cvv;

    /** @var string $first_name Primeiro Nome impresso no cartão de crédito */
    public string $first_name;

    /** @var string $last_name Primeiro Nome impresso no cartão de crédito */
    public string $last_name;

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

    public function setFirstName(string $first_name): CreditCard
    {
        $this->first_name = $first_name;
        return $this;
    }

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function setLastName(string $last_name): CreditCard
    {
        $this->last_name = $last_name;
        return $this;
    }

    public function getLastName(): string
    {
        return $this->last_name;
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
        return [
            'number' => $this->number,
            'verification_value' => $this->cvv,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name ?? null,
            'month' => $this->expire_month,
            'year' => $this->expire_year,
        ];
    }
}