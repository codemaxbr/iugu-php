<?php

namespace Codemax\Entity;

class Item implements \JsonSerializable
{
    /** @var string $description Descrição do item */
    protected string $description;

    /** @var int $quantity Quantidade do item */
    protected int $quantity;

    /** @var int$price_cents Preço do item em centavos. Valor mínimo 100 = R$ 1,00.*/
    protected int $price_cents;

    /** @var string|null ID do item, utilizado só em casos de edição ou remoção. */
    protected ?string $id;

    public function setDescription(string $description): Item
    {
        $this->description = $description;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setQuantity(int $quantity): Item
    {
        $this->quantity = $quantity;
        return $this;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setPriceCents(int $price_cents): Item
    {
        $this->price_cents = $price_cents;
        return $this;
    }

    public function getPriceCents(): int
    {
        return $this->price_cents;
    }

    public function setId(?string $id): Item
    {
        $this->id = $id;
        return $this;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function jsonSerialize()
    {
        return [
            'description' => $this->description,
            'quantity' => $this->quantity,
            'price_cents' => $this->price_cents,
            'id' => $this->id ?? null
        ];
    }
}