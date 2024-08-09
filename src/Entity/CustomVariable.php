<?php

namespace Codemax\Entity;

class CustomVariable implements \JsonSerializable
{
    /** @var string|null $name Nome da variável */
    protected ?string $name;

    /** @var string|null $value Valor da variável */
    protected ?string $value;

    public function setName(?string $name): CustomVariable
    {
        $this->name = $name;
        return $this;
    }

    public function setValue(?string $value): CustomVariable
    {
        $this->value = $value;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function jsonSerialize()
    {
        return [
            'name' => $this->name,
            'value' => $this->value,
        ];
    }
}