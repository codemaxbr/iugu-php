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

    public function jsonSerialize(): mixed
    {
        // TODO: Implement jsonSerialize() method.
    }
}