<?php

namespace Codemax\Entity;

class Payment implements \JsonSerializable
{
    protected Customer $customer;
    protected bool $restrictPaymentMethod;
    protected int $discountCents;
    protected ?PaymentMethod $paymentMethod;
    protected ?string $orderId;
    protected array $items;

    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    public function setCustomer(Customer $customer): Payment
    {
        $this->customer = $customer;
        return $this;
    }

    public function isRestrictPaymentMethod(): bool
    {
        return $this->restrictPaymentMethod;
    }

    public function setRestrictPaymentMethod(bool $restrictPaymentMethod): Payment
    {
        $this->restrictPaymentMethod = $restrictPaymentMethod;
        return $this;
    }

    public function getDiscountCents(): int
    {
        return $this->discountCents;
    }

    public function setDiscountCents(int $discountCents): Payment
    {
        $this->discountCents = $discountCents;
        return $this;
    }

    public function getOrderId(): ?string
    {
        return $this->orderId;
    }

    public function setOrderId(?string $orderId): Payment
    {
        $this->orderId = $orderId;
        return $this;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function setItems(array $items): Payment
    {
        $this->items = $items;
        return $this;
    }

    public function setPaymentMethod(?PaymentMethod $paymentMethod): Payment
    {
        $this->paymentMethod = $paymentMethod;
        return $this;
    }

    public function getPaymentMethod(): ?PaymentMethod
    {
        return $this->paymentMethod;
    }

    public function jsonSerialize()
    {
        return [
            'customer' => $this->customer,
            'restrict_payment_method' => $this->restrictPaymentMethod ?? false,
            'discount_cents' => $this->discountCents ?? 0,
            'payment_method' => $this->paymentMethod ?? null,
            'order_id' => $this->orderId ?? null,
            'items' => $this->items ?? [],
        ];
    }
}