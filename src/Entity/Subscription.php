<?php

namespace Iugu\Entity;

use Carbon\Carbon;

class Subscription implements \JsonSerializable
{
    public ?string $plan_identifier;
    public string $customer_id;
    public ?string $expires_at;
    public ?bool $only_on_charge_success;
    public ?bool $ignore_due_email;
    public array $payable_with = ['all'];
    public ?bool $credits_based;
    public ?int $price_cents;
    public ?int $credits_cycle;
    public ?int $credits_min;
    public ?array $subitems = [];
    public ?array $custom_variables = [];
    public ?bool $two_step;
    public ?bool $suspend_on_invoice_expired;
    public ?bool $only_charge_on_due_date;
    public ?string $soft_descriptor_light;
    public ?string $return_url;

    public function setPlanIdentifier(?string $plan_identifier): Subscription
    {
        $this->plan_identifier = $plan_identifier;
        return $this;
    }

    public function setCustomerId(string $customer_id): Subscription
    {
        $this->customer_id = $customer_id;
        return $this;
    }

    public function setExpiresAt(?Carbon $expires_at): Subscription
    {
        $this->expires_at = $expires_at ? $expires_at->toDateTimeString() : null;
        return $this;
    }

    public function setOnlyOnChargeSuccess(?bool $only_on_charge_success): Subscription
    {
        $this->only_on_charge_success = $only_on_charge_success;
        return $this;
    }

    public function setIgnoreDueEmail(?bool $ignore_due_email): Subscription
    {
        $this->ignore_due_email = $ignore_due_email;
        return $this;
    }

    public function setPayableWith(array $payable_with): Subscription
    {
        $this->payable_with = $payable_with;
        return $this;
    }

    public function setCreditsBased(?bool $credits_based): Subscription
    {
        $this->credits_based = $credits_based;
        return $this;
    }

    public function setPriceCents(?int $price_cents): Subscription
    {
        $this->price_cents = $price_cents;
        return $this;
    }

    public function setCreditsCycle(?int $credits_cycle): Subscription
    {
        $this->credits_cycle = $credits_cycle;
        return $this;
    }

    public function setCreditsMin(?int $credits_min): Subscription
    {
        $this->credits_min = $credits_min;
        return $this;
    }

    public function setSubitems(array $subitems): Subscription
    {
        $this->subitems = $subitems;
        return $this;
    }

    public function setCustomVariables(array $custom_variables): Subscription
    {
        $this->custom_variables = $custom_variables;
        return $this;
    }

    public function setTwoStep(?bool $two_step): Subscription
    {
        $this->two_step = $two_step;
        return $this;
    }

    public function setSuspendOnInvoiceExpired(?bool $suspend_on_invoice_expired): Subscription
    {
        $this->suspend_on_invoice_expired = $suspend_on_invoice_expired;
        return $this;
    }

    public function setOnlyChargeOnDueDate(?bool $only_charge_on_due_date): Subscription
    {
        $this->only_charge_on_due_date = $only_charge_on_due_date;
        return $this;
    }

    public function setSoftDescriptorLight(?string $soft_descriptor_light): Subscription
    {
        $this->soft_descriptor_light = $soft_descriptor_light;
        return $this;
    }

    public function setReturnUrl(?string $return_url): Subscription
    {
        $this->return_url = $return_url;
        return $this;
    }

    public function getPlanIdentifier(): ?string
    {
        return $this->plan_identifier;
    }

    public function getCustomerId(): string
    {
        return $this->customer_id;
    }

    public function getExpiresAt(): ?Carbon
    {
        return $this->expires_at ? new Carbon($this->expires_at) : null;
    }

    public function getOnlyOnChargeSuccess(): ?bool
    {
        return $this->only_on_charge_success;
    }

    public function getIgnoreDueEmail(): ?bool
    {
        return $this->ignore_due_email;
    }

    public function getPayableWith(): array
    {
        return $this->payable_with;
    }

    public function getCreditsBased(): ?bool
    {
        return $this->credits_based;
    }

    public function getPriceCents(): ?int
    {
        return $this->price_cents;
    }

    public function getCreditsCycle(): ?int
    {
        return $this->credits_cycle;
    }

    public function getCreditsMin(): ?int
    {
        return $this->credits_min;
    }

    public function getSubitems(): array
    {
        return $this->subitems;
    }

    public function getCustomVariables(): array
    {
        return $this->custom_variables;
    }

    public function getTwoStep(): ?bool
    {
        return $this->two_step;
    }

    public function getSuspendOnInvoiceExpired(): ?bool
    {
        return $this->suspend_on_invoice_expired;
    }

    public function getOnlyChargeOnDueDate(): ?bool
    {
        return $this->only_charge_on_due_date;
    }

    public function getSoftDescriptorLight(): ?string
    {
        return $this->soft_descriptor_light;
    }

    public function getReturnUrl(): ?string
    {
        return $this->return_url;
    }

    public function jsonSerialize()
    {
        return [
            'plan_identifier' => $this->plan_identifier ?? null,
            'customer_id' => $this->customer_id,
            'expires_at' => $this->expires_at ?? null,
            'only_on_charge_success' => $this->only_on_charge_success ?? true,
            'ignore_due_email' => $this->ignore_due_email ?? true,
            'payable_with' => $this->payable_with ?? null,
            'credits_based' => $this->credits_based ?? null,
            'price_cents' => $this->price_cents ?? null,
            'credits_cycle' => $this->credits_cycle ?? null,
            'credits_min' => $this->credits_min ?? null,
            'subitems' => $this->subitems ?? null,
            'custom_variables' => $this->custom_variables ?? null,
            'two_step' => $this->two_step ?? null,
            'suspend_on_invoice_expired' => $this->suspend_on_invoice_expired ?? null,
            'only_charge_on_due_date' => $this->only_charge_on_due_date ?? null,
            'soft_descriptor_light' => $this->soft_descriptor_light ?? null,
            'return_url' => $this->return_url ?? null,
        ];
    }
}