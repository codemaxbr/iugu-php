<?php

namespace Iugu\Entity;

use Iugu\Base\IntervalType;

class Plan implements \JsonSerializable
{
    public string $name;
    public string $identifier;
    public int $interval;
    public string $interval_type = IntervalType::MONTHS;
    public int $value_cents;
    public ?array $payable_with = ['all'];
    public ?array $features = [];
    public ?int $billing_days;
    public ?int $max_cycles;
    public ?int $invoice_max_installments;

    public function setName(string $name): Plan
    {
        $this->name = $name;
        return $this;
    }

    public function setIdentifier(string $identifier): Plan
    {
        $this->identifier = $identifier;
        return $this;
    }

    public function setInterval(int $interval): Plan
    {
        $this->interval = $interval;
        return $this;
    }

    public function setIntervalType(string $interval_type): Plan
    {
        $this->interval_type = $interval_type;
        return $this;
    }

    public function setValueCents(int $value_cents): Plan
    {
        $this->value_cents = $value_cents;
        return $this;
    }

    public function setPayableWith(?array $payable_with): Plan
    {
        $this->payable_with = $payable_with;
        return $this;
    }

    public function setFeatures(?array $features): Plan
    {
        $this->features = $features;
        return $this;
    }

    public function setBillingDays(?int $billing_days): Plan
    {
        $this->billing_days = $billing_days;
        return $this;
    }

    public function setMaxCycles(?int $max_cycles): Plan
    {
        $this->max_cycles = $max_cycles;
        return $this;
    }

    public function setInvoiceMaxInstallments(?int $invoice_max_installments): Plan
    {
        $this->invoice_max_installments = $invoice_max_installments;
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

    public function getInterval(): int
    {
        return $this->interval;
    }

    public function getIntervalType(): string
    {
        return $this->interval_type;
    }

    public function getValueCents(): int
    {
        return $this->value_cents;
    }

    public function getPayableWith(): ?array
    {
        return $this->payable_with;
    }

    public function getFeatures(): ?array
    {
        return $this->features;
    }

    public function getBillingDays(): ?int
    {
        return $this->billing_days;
    }

    public function getMaxCycles(): ?int
    {
        return $this->max_cycles;
    }

    public function getInvoiceMaxInstallments(): ?int
    {
        return $this->invoice_max_installments;
    }

    public function jsonSerialize()
    {
        return [
            'name' => $this->name,
            'identifier' => $this->identifier,
            'interval' => $this->interval ?? 1,
            'interval_type' => $this->interval_type ?? IntervalType::MONTHS,
            'value_cents' => $this->value_cents,
            'payable_with' => $this->payable_with ?? ['all'],
            'features' => $this->features ?? [],
            'billing_days' => $this->billing_days ?? 10,
            'max_cycles' => $this->max_cycles ?? 0,
            'invoice_max_installments' => $this->invoice_max_installments ?? null,
        ];
    }
}