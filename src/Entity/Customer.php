<?php

namespace Codemax\Entity;

class Customer implements \JsonSerializable
{
    /** @var string $name Nome do cliente */
    protected string $name;

    /** @var string $email E-mail do cliente */
    protected string $email;

    /** @var string|null $notes Notas */
    protected ?string $notes;

    /** @var int|null $phone Número do Telefone - 9 dígitos */
    protected ?int $phone;

    /** @var int|null $phone_prefix Prefixo, apenas números - 3 dígitos (obrigatório caso preencha "phone") */
    protected ?int $phone_prefix;

    /**
     * CPF ou CNPJ do cliente. Obrigatório para emissão de boletos registrados. (apenas números)
     * @var string|null $cpf_cnpj
     */
    protected ?string $cpf_cnpj;

    /** @var string|null $cc_emails Endereços de E-mail para cópia separados por vírgula */
    protected ?string $cc_emails;

    /** @var string|null $zip_code CEP. Obrigatório para emissão de boletos registrados */
    protected ?string $zip_code;

    /** @var string|null $number Número do endereço (obrigatório caso "zip_code" seja enviado). */
    protected ?string $number;

    /** @var string|null $street Rua. Obrigatório caso CEP seja incompleto. */
    protected ?string $street;

    protected ?string $city;
    protected ?string $state;

    /** @var string|null $district Bairro. Obrigatório caso CEP seja incompleto. */
    protected ?string $district;

    /** @var string|null $complement Complemento de endereço. Ponto de referência. */
    protected ?string $complement;

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): Customer
    {
        $this->email = $email;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Customer
    {
        $this->name = $name;
        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): Customer
    {
        $this->notes = $notes;
        return $this;
    }

    public function getPhone(): ?int
    {
        return $this->phone;
    }

    public function setPhone(?int $phone): Customer
    {
        $this->phone = $phone;
        return $this;
    }

    public function getPhonePrefix(): ?int
    {
        return $this->phone_prefix;
    }

    public function setPhonePrefix(?int $phone_prefix): Customer
    {
        $this->phone_prefix = $phone_prefix;
        return $this;
    }

    public function getCpfCnpj(): ?string
    {
        return $this->cpf_cnpj;
    }

    public function setCpfCnpj(?string $cpf_cnpj): Customer
    {
        $this->cpf_cnpj = $cpf_cnpj;
        return $this;
    }

    public function getCcEmails(): ?string
    {
        return $this->cc_emails;
    }

    public function setCcEmails(?string $cc_emails): Customer
    {
        $this->cc_emails = $cc_emails;
        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zip_code;
    }

    public function setZipCode(?string $zip_code): Customer
    {
        $this->zip_code = $zip_code;
        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(?string $number): Customer
    {
        $this->number = $number;
        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(?string $street): Customer
    {
        $this->street = $street;
        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): Customer
    {
        $this->city = $city;
        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(?string $state): Customer
    {
        $this->state = $state;
        return $this;
    }

    public function getDistrict(): ?string
    {
        return $this->district;
    }

    public function setDistrict(?string $district): Customer
    {
        $this->district = $district;
        return $this;
    }

    public function getComplement(): ?string
    {
        return $this->complement;
    }

    public function setComplement(?string $complement): Customer
    {
        $this->complement = $complement;
        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'notes' => $this->notes ?? null,
            'phone' => $this->phone ?? null,
            'phone_prefix' => $this->phone_prefix ?? null,
            'cpf_cnpj' => $this->cpf_cnpj ?? null,
            'cc_emails' => $this->cc_emails ?? null,
            'zip_code' => $this->zip_code ?? null,
            'number' => $this->number ?? null,
            'street' => $this->street ?? null,
            'city' => $this->city ?? null,
            'state' => $this->state ?? null,
            'district' => $this->district ?? null,
            'complement' => $this->complement ?? null,
        ];
    }
}