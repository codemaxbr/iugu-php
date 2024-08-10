<?php

namespace Iugu\Entity;

class Payment implements \JsonSerializable
{
    /**
     * Apenas suporta "bank_slip", que é boleto bancário. Não é preenchido se enviar parâmetro token
     *
     * @var string|null $method
     */
    public ?string $method;

    /**
     * ID do Token. Não é preenchido caso o método de pagamento seja "bank_slip". Em caso de Marketplace,
     * é possível enviar um token criado pela conta mestre.
     *
     * @var string|null $token
     */
    protected ?string $token;

    /**
     * ID da Forma de Pagamento do Cliente. Em caso de Marketplace, é possível enviar um "customer_payment_method_id"
     * de um Cliente criado pela conta mestre
     * Não é preenchido caso Método de Pagamento seja "bank_slip" ou utilize "token"
     *
     * @var string|null $customer_payment_method_id
     */
    protected ?string $customer_payment_method_id;

    /**
     * Se true, restringe o método de pagamento da cobrança para o definido em method, que no caso será apenas bank_slip.
     *
     * @var bool $restrict_payment_method
     */
    protected bool $restrict_payment_method;

    /** @var string $customer_id ID do Cliente na Iugu. Utilizado para vincular a Fatura a um Cliente */
    protected string $customer_id;

    /** @var string $invoice_id ID da Fatura a ser utilizada para pagamento */
    protected string $invoice_id;

    /** @var string|null $email E-mail do Cliente (não é preenchido caso seja enviado um "invoice_id") */
    protected ?string $email;

    /**
     * Número de Parcelas (2 até 12), não é necessário passar 1.
     * Não é preenchido caso o método de pagamento seja "bank_slip".
     * O valor mínino de cada parcela é de R$5,00.
     *
     * @var int $months
     */
    protected int $months;

    /**
     * Valor de desconto, em centavos, aplicado sobre os itens criados em caso de não haver fatura vinculada à chamada.
     *
     * @var int $discount_cents
     */
    protected int $discount_cents;

    /**
     * Define o prazo em dias para o pagamento do boleto.
     * Caso não seja enviado, aplica-se o prazo padrão de 3 dias corridos.
     *
     * @var int $bank_slip_extra_days
     */
    protected int $bank_slip_extra_days;

    /**
     * Por padrão, a fatura é cancelada caso haja falha na cobrança, a não ser que este parâmetro seja enviado como "true".
     * Obs: Funcionalidade disponível apenas para faturas criadas no momento da cobrança.
     *
     * @var bool $keep_dunning
     */
    protected bool $keep_dunning;

    /**
     * Itens da cobrança. "price_cents" valor mínimo de 100 (R$ 1,00)
     *
     * @var ?Item[] $items
     */
    protected ?array $items;

    /**
     * Informações do cliente abaixo "payer" são obrigatórias para a emissão de boletos ou necessárias para seu sistema de antifraude.
     *
     * @var Payer $payer
     */
    protected Payer $payer;

    /**
     * Número único que identifica o pedido de compra. Opcional, ajuda a evitar o pagamento da mesma fatura.
     *
     * @var string|null $order_id
     */
    protected ?string $order_id;

    public function setMethod(?string $method): Payment
    {
        $this->method = $method;
        return $this;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function setToken(?string $token): Payment
    {
        $this->token = $token;
        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setCustomerPaymentMethodId(?string $customer_payment_method_id): Payment
    {
        $this->customer_payment_method_id = $customer_payment_method_id;
        return $this;
    }

    public function getCustomerPaymentMethodId(): ?string
    {
        return $this->customer_payment_method_id;
    }

    public function setRestrictPaymentMethod(bool $restrict_payment_method): Payment
    {
        $this->restrict_payment_method = $restrict_payment_method;
        return $this;
    }

    public function isRestrictPaymentMethod(): bool
    {
        return $this->restrict_payment_method;
    }

    public function setCustomerId(string $customer_id): Payment
    {
        $this->customer_id = $customer_id;
        return $this;
    }

    public function getCustomerId(): string
    {
        return $this->customer_id;
    }

    public function setInvoiceId(string $invoice_id): Payment
    {
        $this->invoice_id = $invoice_id;
        return $this;
    }

    public function getInvoiceId(): string
    {
        return $this->invoice_id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): Payment
    {
        $this->email = $email;
        return $this;
    }

    public function getMonths(): int
    {
        return $this->months;
    }

    public function setMonths(int $months): Payment
    {
        $this->months = $months;
        return $this;
    }

    public function getDiscountCents(): int
    {
        return $this->discount_cents;
    }

    public function setDiscountCents(int $discount_cents): Payment
    {
        $this->discount_cents = $discount_cents;
        return $this;
    }

    public function getBankSlipExtraDays(): int
    {
        return $this->bank_slip_extra_days;
    }

    public function setBankSlipExtraDays(int $bank_slip_extra_days): Payment
    {
        $this->bank_slip_extra_days = $bank_slip_extra_days;
        return $this;
    }

    public function isKeepDunning(): bool
    {
        return $this->keep_dunning;
    }

    public function setKeepDunning(bool $keep_dunning): Payment
    {
        $this->keep_dunning = $keep_dunning;
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

    public function getPayer(): Payer
    {
        return $this->payer;
    }

    public function setPayer(Payer $payer): Payment
    {
        $this->payer = $payer;
        return $this;
    }

    public function getOrderId(): ?string
    {
        return $this->order_id;
    }

    public function setOrderId(?string $order_id): Payment
    {
        $this->order_id = $order_id;
        return $this;
    }

    public function jsonSerialize()
    {
        $body = [
            'token' => $this->token ?? null,
            'customer_payment_method_id' => $this->customer_payment_method_id ?? null,
            'restrict_payment_method' => $this->restrict_payment_method ?? false,
            'customer_id' => $this->customer_id,
            'invoice_id' => $this->invoice_id ?? null,
            'email' => $this->email ?? null,
            'months' => $this->months ?? null,
            'discount_cents' => $this->discount_cents ?? null,
            'bank_slip_extra_days' => $this->bank_slip_extra_days ?? null,
            'keep_dunning' => $this->keep_dunning ?? false,
            'items' => $this->items ?? [],
            'payer' => $this->payer,
            'order_id' => $this->order_id ?? null,
        ];

        if (!empty($this->method)) {
            $body['method'] = $this->method;
            unset($body['customer_payment_method_id']);
            unset($body['token']);
        }

        if (!empty($this->token)) {
            unset($body['customer_payment_method_id']);
            unset($body['method']);
        }

        return $body;
    }
}