<?php

namespace Codemax\Entity;

class Split implements \JsonSerializable
{
    /** @var string|null $recipient_account_id ID Da conta que irá receber o split */
    protected ?string $recipient_account_id;

    /** @var int|null $cents Centavos a serem cobrados da fatura */
    protected ?int $cents;

    /** @var float|null Porcentagem a ser cobrada da fatura */
    protected ?float $percent;

    /** @var int|null $bank_slip_cents Valor em centavos a ser cobrado apenas em transações no boleto. */
    protected ?int $bank_slip_cents;

    /** @var float|null $bank_slip_percent Valor em porcentagem a ser cobrado apenas em transações no boleto.  */
    protected ?float $bank_slip_percent;

    /** @var int|null $card_slip_cents Valor em centavos a ser cobrado apenas em transações no cartão de crédito. */
    protected ?int $card_slip_cents;

    /** @var float|null $card_slip_percent Valor em porcentagem a ser cobrado apenas em transações no cartão de crédito. */
    protected ?float $card_slip_percent;

    /** @var int|null $pix_cents Valor em centavos a ser cobrado apenas em transações no pix. */
    protected ?int $pix_cents;

    /** @var float|null $pix_percent Valor em porcentagem a ser cobrado apenas em transações no pix. */
    protected ?float $pix_percent;

    /** @var bool|null $permit_aggregated Permite agregar comissionamento percentual + fixo. */
    protected ?bool $permit_aggregated;

    /** @var string $credit_card_1x_cents Valor em centavos a ser cobrado apenas em transações em 1x no cartão de crédito. */
    protected string $credit_card_1x_cents;
    protected string $credit_card_2x_cents;
    protected string $credit_card_3x_cents;
    protected string $credit_card_4x_cents;
    protected string $credit_card_5x_cents;
    protected string $credit_card_6x_cents;
    protected string $credit_card_7x_cents;
    protected string $credit_card_8x_cents;
    protected string $credit_card_9x_cents;
    protected string $credit_card_10x_cents;
    protected string $credit_card_11x_cents;
    protected string $credit_card_12x_cents;

    /** @var string $credit_card_1x_percent Valor em porcentagem a ser cobrado apenas em transações em 1x no cartão de crédito. */
    protected string $credit_card_1x_percent;
    protected string $credit_card_2x_percent;
    protected string $credit_card_3x_percent;
    protected string $credit_card_4x_percent;
    protected string $credit_card_5x_percent;
    protected string $credit_card_6x_percent;
    protected string $credit_card_7x_percent;
    protected string $credit_card_8x_percent;
    protected string $credit_card_9x_percent;
    protected string $credit_card_10x_percent;
    protected string $credit_card_11x_percent;
    protected string $credit_card_12x_percent;

    /**
     * @return string|null
     */
    public function getRecipientAccountId(): ?string
    {
        return $this->recipient_account_id;
    }

    /**
     * @param string|null $recipient_account_id
     * @return Split
     */
    public function setRecipientAccountId(?string $recipient_account_id): Split
    {
        $this->recipient_account_id = $recipient_account_id;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getCents(): ?int
    {
        return $this->cents;
    }

    /**
     * @param int|null $cents
     * @return Split
     */
    public function setCents(?int $cents): Split
    {
        $this->cents = $cents;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getPercent(): ?float
    {
        return $this->percent;
    }

    /**
     * @param float|null $percent
     * @return Split
     */
    public function setPercent(?float $percent): Split
    {
        $this->percent = $percent;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getBankSlipCents(): ?int
    {
        return $this->bank_slip_cents;
    }

    /**
     * @param int|null $bank_slip_cents
     * @return Split
     */
    public function setBankSlipCents(?int $bank_slip_cents): Split
    {
        $this->bank_slip_cents = $bank_slip_cents;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getBankSlipPercent(): ?float
    {
        return $this->bank_slip_percent;
    }

    /**
     * @param float|null $bank_slip_percent
     * @return Split
     */
    public function setBankSlipPercent(?float $bank_slip_percent): Split
    {
        $this->bank_slip_percent = $bank_slip_percent;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getCardSlipCents(): ?int
    {
        return $this->card_slip_cents;
    }

    /**
     * @param int|null $card_slip_cents
     * @return Split
     */
    public function setCardSlipCents(?int $card_slip_cents): Split
    {
        $this->card_slip_cents = $card_slip_cents;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getCardSlipPercent(): ?float
    {
        return $this->card_slip_percent;
    }

    /**
     * @param float|null $card_slip_percent
     * @return Split
     */
    public function setCardSlipPercent(?float $card_slip_percent): Split
    {
        $this->card_slip_percent = $card_slip_percent;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getPixCents(): ?int
    {
        return $this->pix_cents;
    }

    /**
     * @param int|null $pix_cents
     * @return Split
     */
    public function setPixCents(?int $pix_cents): Split
    {
        $this->pix_cents = $pix_cents;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getPixPercent(): ?float
    {
        return $this->pix_percent;
    }

    /**
     * @param float|null $pix_percent
     * @return Split
     */
    public function setPixPercent(?float $pix_percent): Split
    {
        $this->pix_percent = $pix_percent;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getPermitAggregated(): ?bool
    {
        return $this->permit_aggregated;
    }

    /**
     * @param bool|null $permit_aggregated
     * @return Split
     */
    public function setPermitAggregated(?bool $permit_aggregated): Split
    {
        $this->permit_aggregated = $permit_aggregated;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreditCard1xCents(): string
    {
        return $this->credit_card_1x_cents;
    }

    /**
     * @param string $credit_card_1x_cents
     * @return Split
     */
    public function setCreditCard1xCents(string $credit_card_1x_cents): Split
    {
        $this->credit_card_1x_cents = $credit_card_1x_cents;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreditCard2xCents(): string
    {
        return $this->credit_card_2x_cents;
    }

    /**
     * @param string $credit_card_2x_cents
     * @return Split
     */
    public function setCreditCard2xCents(string $credit_card_2x_cents): Split
    {
        $this->credit_card_2x_cents = $credit_card_2x_cents;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreditCard3xCents(): string
    {
        return $this->credit_card_3x_cents;
    }

    /**
     * @param string $credit_card_3x_cents
     * @return Split
     */
    public function setCreditCard3xCents(string $credit_card_3x_cents): Split
    {
        $this->credit_card_3x_cents = $credit_card_3x_cents;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreditCard4xCents(): string
    {
        return $this->credit_card_4x_cents;
    }

    /**
     * @param string $credit_card_4x_cents
     * @return Split
     */
    public function setCreditCard4xCents(string $credit_card_4x_cents): Split
    {
        $this->credit_card_4x_cents = $credit_card_4x_cents;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreditCard5xCents(): string
    {
        return $this->credit_card_5x_cents;
    }

    /**
     * @param string $credit_card_5x_cents
     * @return Split
     */
    public function setCreditCard5xCents(string $credit_card_5x_cents): Split
    {
        $this->credit_card_5x_cents = $credit_card_5x_cents;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreditCard6xCents(): string
    {
        return $this->credit_card_6x_cents;
    }

    /**
     * @param string $credit_card_6x_cents
     * @return Split
     */
    public function setCreditCard6xCents(string $credit_card_6x_cents): Split
    {
        $this->credit_card_6x_cents = $credit_card_6x_cents;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreditCard7xCents(): string
    {
        return $this->credit_card_7x_cents;
    }

    /**
     * @param string $credit_card_7x_cents
     * @return Split
     */
    public function setCreditCard7xCents(string $credit_card_7x_cents): Split
    {
        $this->credit_card_7x_cents = $credit_card_7x_cents;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreditCard8xCents(): string
    {
        return $this->credit_card_8x_cents;
    }

    /**
     * @param string $credit_card_8x_cents
     * @return Split
     */
    public function setCreditCard8xCents(string $credit_card_8x_cents): Split
    {
        $this->credit_card_8x_cents = $credit_card_8x_cents;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreditCard9xCents(): string
    {
        return $this->credit_card_9x_cents;
    }

    /**
     * @param string $credit_card_9x_cents
     * @return Split
     */
    public function setCreditCard9xCents(string $credit_card_9x_cents): Split
    {
        $this->credit_card_9x_cents = $credit_card_9x_cents;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreditCard10xCents(): string
    {
        return $this->credit_card_10x_cents;
    }

    /**
     * @param string $credit_card_10x_cents
     * @return Split
     */
    public function setCreditCard10xCents(string $credit_card_10x_cents): Split
    {
        $this->credit_card_10x_cents = $credit_card_10x_cents;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreditCard11xCents(): string
    {
        return $this->credit_card_11x_cents;
    }

    /**
     * @param string $credit_card_11x_cents
     * @return Split
     */
    public function setCreditCard11xCents(string $credit_card_11x_cents): Split
    {
        $this->credit_card_11x_cents = $credit_card_11x_cents;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreditCard12xCents(): string
    {
        return $this->credit_card_12x_cents;
    }

    /**
     * @param string $credit_card_12x_cents
     * @return Split
     */
    public function setCreditCard12xCents(string $credit_card_12x_cents): Split
    {
        $this->credit_card_12x_cents = $credit_card_12x_cents;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreditCard1xPercent(): string
    {
        return $this->credit_card_1x_percent;
    }

    /**
     * @param string $credit_card_1x_percent
     * @return Split
     */
    public function setCreditCard1xPercent(string $credit_card_1x_percent): Split
    {
        $this->credit_card_1x_percent = $credit_card_1x_percent;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreditCard2xPercent(): string
    {
        return $this->credit_card_2x_percent;
    }

    /**
     * @param string $credit_card_2x_percent
     * @return Split
     */
    public function setCreditCard2xPercent(string $credit_card_2x_percent): Split
    {
        $this->credit_card_2x_percent = $credit_card_2x_percent;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreditCard3xPercent(): string
    {
        return $this->credit_card_3x_percent;
    }

    /**
     * @param string $credit_card_3x_percent
     * @return Split
     */
    public function setCreditCard3xPercent(string $credit_card_3x_percent): Split
    {
        $this->credit_card_3x_percent = $credit_card_3x_percent;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreditCard4xPercent(): string
    {
        return $this->credit_card_4x_percent;
    }

    /**
     * @param string $credit_card_4x_percent
     * @return Split
     */
    public function setCreditCard4xPercent(string $credit_card_4x_percent): Split
    {
        $this->credit_card_4x_percent = $credit_card_4x_percent;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreditCard5xPercent(): string
    {
        return $this->credit_card_5x_percent;
    }

    /**
     * @param string $credit_card_5x_percent
     * @return Split
     */
    public function setCreditCard5xPercent(string $credit_card_5x_percent): Split
    {
        $this->credit_card_5x_percent = $credit_card_5x_percent;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreditCard6xPercent(): string
    {
        return $this->credit_card_6x_percent;
    }

    /**
     * @param string $credit_card_6x_percent
     * @return Split
     */
    public function setCreditCard6xPercent(string $credit_card_6x_percent): Split
    {
        $this->credit_card_6x_percent = $credit_card_6x_percent;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreditCard7xPercent(): string
    {
        return $this->credit_card_7x_percent;
    }

    /**
     * @param string $credit_card_7x_percent
     * @return Split
     */
    public function setCreditCard7xPercent(string $credit_card_7x_percent): Split
    {
        $this->credit_card_7x_percent = $credit_card_7x_percent;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreditCard8xPercent(): string
    {
        return $this->credit_card_8x_percent;
    }

    /**
     * @param string $credit_card_8x_percent
     * @return Split
     */
    public function setCreditCard8xPercent(string $credit_card_8x_percent): Split
    {
        $this->credit_card_8x_percent = $credit_card_8x_percent;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreditCard9xPercent(): string
    {
        return $this->credit_card_9x_percent;
    }

    /**
     * @param string $credit_card_9x_percent
     * @return Split
     */
    public function setCreditCard9xPercent(string $credit_card_9x_percent): Split
    {
        $this->credit_card_9x_percent = $credit_card_9x_percent;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreditCard10xPercent(): string
    {
        return $this->credit_card_10x_percent;
    }

    /**
     * @param string $credit_card_10x_percent
     * @return Split
     */
    public function setCreditCard10xPercent(string $credit_card_10x_percent): Split
    {
        $this->credit_card_10x_percent = $credit_card_10x_percent;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreditCard11xPercent(): string
    {
        return $this->credit_card_11x_percent;
    }

    /**
     * @param string $credit_card_11x_percent
     * @return Split
     */
    public function setCreditCard11xPercent(string $credit_card_11x_percent): Split
    {
        $this->credit_card_11x_percent = $credit_card_11x_percent;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreditCard12xPercent(): string
    {
        return $this->credit_card_12x_percent;
    }

    /**
     * @param string $credit_card_12x_percent
     * @return Split
     */
    public function setCreditCard12xPercent(string $credit_card_12x_percent): Split
    {
        $this->credit_card_12x_percent = $credit_card_12x_percent;
        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'recipient_account_id' => $this->recipient_account_id ?? null,
            'cents' => $this->cents ?? null,
            'percent' => $this->percent ?? null,
            'bank_slip_cents' => $this->bank_slip_cents ?? null,
            'bank_slip_percent' => $this->bank_slip_percent ?? null,
            'card_slip_cents' => $this->card_slip_cents ?? null,
            'card_slip_percent' => $this->card_slip_percent ?? null,
            'pix_cents' => $this->pix_cents ?? null,
            'pix_percent' => $this->pix_percent ?? null,
            'permit_aggregated' => $this->permit_aggregated ?? null,
            'credit_card_1x_cents' => $this->credit_card_1x_cents ?? null,
            'credit_card_2x_cents' => $this->credit_card_2x_cents ?? null,
            'credit_card_3x_cents' => $this->credit_card_3x_cents ?? null,
            'credit_card_4x_cents' => $this->credit_card_4x_cents ?? null,
            'credit_card_5x_cents' => $this->credit_card_5x_cents ?? null,
            'credit_card_6x_cents' => $this->credit_card_6x_cents ?? null,
            'credit_card_7x_cents' => $this->credit_card_7x_cents ?? null,
            'credit_card_8x_cents' => $this->credit_card_8x_cents ?? null,
            'credit_card_9x_cents' => $this->credit_card_9x_cents ?? null,
            'credit_card_10x_cents' => $this->credit_card_10x_cents ?? null,
            'credit_card_11x_cents' => $this->credit_card_11x_cents ?? null,
            'credit_card_12x_cents' => $this->credit_card_12x_cents ?? null,
            'credit_card_1x_percent' => $this->credit_card_1x_percent ?? null,
            'credit_card_2x_percent' => $this->credit_card_2x_percent ?? null,
            'credit_card_3x_percent' => $this->credit_card_3x_percent ?? null,
            'credit_card_4x_percent' => $this->credit_card_4x_percent ?? null,
            'credit_card_5x_percent' => $this->credit_card_5x_percent ?? null,
            'credit_card_6x_percent' => $this->credit_card_6x_percent ?? null,
            'credit_card_7x_percent' => $this->credit_card_7x_percent ?? null,
            'credit_card_8x_percent' => $this->credit_card_8x_percent ?? null,
            'credit_card_9x_percent' => $this->credit_card_9x_percent ?? null,
            'credit_card_10x_percent' => $this->credit_card_10x_percent ?? null,
            'credit_card_11x_percent' => $this->credit_card_11x_percent ?? null,
            'credit_card_12x_percent' => $this->credit_card_12x_percent ?? null,
        ];
    }
}