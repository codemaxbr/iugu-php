<?php

namespace Codemax\Entity;

class PaymentToken implements \JsonSerializable
{
    /** @var string $account_id ID da conta na Iugu */
    public string $account_id;

    /** @var string $method Método de pagamento */
    public string $method = 'credit_card';

    /** @var bool $test Define se vai criar token com cartão de testes */
    public bool $test = true;

    /** @var CreditCard $data Dados do cartão de crédito */
    public CreditCard $data;

    public function setAccountId(string $account_id): PaymentToken
    {
        $this->account_id = $account_id;
        return $this;
    }

    public function getAccountId(): string
    {
        return $this->account_id;
    }

    public function setTest(bool $test): PaymentToken
    {
        $this->test = $test;
        return $this;
    }

    public function setData(CreditCard $data): PaymentToken
    {
        $this->data = $data;
        return $this;
    }

    public function getData(): CreditCard
    {
        return $this->data;
    }

    public function isTest(): bool
    {
        return $this->test;
    }

    public function jsonSerialize()
    {
        return [
            'account_id' => $this->getAccountId(),
            'method' => $this->method,
            'test' => $this->test ?? false,
            'data' => $this->getData(),
        ];
    }
}