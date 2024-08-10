<?php

namespace Iugu\Entity;

class Address implements \JsonSerializable
{
    /** @var string $zip_code CEP */
    protected string $zip_code;

    /** @var string $street Rua */
    protected string $street;

    /** @var string $number Número */
    protected string $number;

    /** @var string $district Bairro */
    protected string $district;

    /** @var string $city Cidade */
    protected string $city;

    /** @var string $state Estado */
    protected string $state;

    /** @var string|null $complement Complemento */
    protected ?string $complement;

    public function setZipCode(string $zip_code): Address
    {
        $this->zip_code = $zip_code;
        return $this;
    }

    public function getZipCode(): string
    {
        return $this->zip_code;
    }

    public function setStreet(string $street): Address
    {
        $this->street = $street;
        return $this;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function setNumber(string $number): Address
    {
        $this->number = $number;
        return $this;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function setDistrict(string $district): Address
    {
        $this->district = $district;
        return $this;
    }

    public function getDistrict(): string
    {
        return $this->district;
    }

    public function setCity(string $city): Address
    {
        $this->city = $city;
        return $this;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setState(string $state): Address
    {
        $this->state = $state;
        return $this;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function setComplement(?string $complement): Address
    {
        $this->complement = $complement;
        return $this;
    }

    public function getComplement(): ?string
    {
        return $this->complement;
    }

    public function jsonSerialize()
    {
        return [
            'zip_code' => $this->zip_code,
            'street' => $this->street,
            'number' => $this->number,
            'district' => $this->district,
            'city' => $this->city,
            'state' => $this->state,
            'complement' => $this->complement ?? null,
        ];
    }
}