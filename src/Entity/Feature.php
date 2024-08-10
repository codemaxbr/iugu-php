<?php

namespace Iugu\Entity;

class Feature implements \JsonSerializable
{
    public string $name;
    public string $identifier;
    public int $value;

    public function setName(string $name): Feature
    {
        $this->name = $name;
        return $this;
    }

    public function setIdentifier(string $identifier): Feature
    {
        $this->identifier = $identifier;
        return $this;
    }

    public function setValue(int $value): Feature
    {
        $this->value = $value;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function jsonSerialize()
    {
        return [
            'name' => $this->name,
            'identifier' => $this->identifier,
            'value' => $this->value,
        ];
    }
}