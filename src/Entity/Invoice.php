<?php

namespace Codemax\Entity;

use Carbon\Carbon;

class Invoice implements \JsonSerializable
{
    /* @var string $email E-mail do cliente */
    protected string $email;

    /** @var string|null $cc_emails Endereços de E-mail para cópia separados por ponto e vírgula. */
    protected ?string $cc_emails;

    /** @var string Data do vencimento. (Formato: 'AAAA-MM-DD'). */
    protected string $due_date;

    /**
     * Se true, garante que a data de vencimento seja apenas em dias de semana, e não em sábados ou domingos.
     *
     * @var bool $ensure_workday_due_date
     */
    protected bool $ensure_workday_due_date = false;

    /** @var Item[] $items Itens da fatura. "price_cents" valor mínimo 100. Limite de 30 items */
    protected array $items;

    /**
     * Cliente é redirecionado para essa URL após efetuar o pagamento da Fatura pela página de Fatura da Iugu
     *
     * @var string|null $return_url
     */
    protected ?string $return_url;

    /**
     * Cliente é redirecionado para essa URL se a Fatura que estiver acessando estiver expirada
     *
     * @var string|null $expired_url
     */
    protected ?string $expired_url;

    /**
     * URL chamada para todas as notificações de Fatura, assim como os webhooks (Gatilhos) são chamados
     *
     * @var string|null $notification_url
     */
    protected ?string $notification_url;

    /** @var bool|null $ignore_canceled_email Desliga o e-mail de cancelamento de fatura */
    protected ?bool $ignore_canceled_email;

    /** @var bool|null $fines Booleano para Habilitar ou Desabilitar multa por atraso de pagamento */
    protected ?bool $fines;

    /**
     * Determine a multa % a ser cobrada para pagamentos efetuados após a data de vencimento
     *
     * @var int|null $late_payment_fine
     */
    protected ?int $late_payment_fine;

    /**
     * Booleano que determina se cobra ou não juros por dia de atraso. 1% ao mês pro rata.
     * Necessário passar a multa como true
     *
     * @var bool|null $per_day_interest
     */
    protected ?bool $per_day_interest;

    /** @var int|null $per_day_interest_value Informar o valor percentual de juros que deseja cobrar */
    protected ?int $per_day_interest_value;

    /**
     * Juros a ser cobrado por dia em centavos. Tem prioridade sobre per_day_interest_value.
     * @var int|null $per_day_interest_cents
     */
    protected ?int $per_day_interest_cents;

    /** @var int|null $discount_cents Valor dos Descontos em centavos */
    protected ?int $discount_cents;

    /** @var string|null $customer_id ID do Cliente */
    protected ?string $customer_id;

    /** @var bool|null $ignore_due_email Booleano que ignora o envio do e-mail de cobrança */
    protected ?bool $ignore_due_email;

    /**
     * Amarra esta Fatura com a Assinatura especificada. Esta fatura não causa alterações na assinatura vinculada.
     *
     * @var string|null $subscription_id
     */
    protected ?string $subscription_id;

    /**
     * Método de pagamento que será disponibilizado para esta Fatura ("all", "credit_card", "bank_slip" ou "pix").
     * Obs: Caso esta Fatura esteja atrelada à uma Assinatura, a prioridade é herdar o valor atribuído na Assinatura;
     * caso esta esteja atribuído o valor 'all', o sistema considerará o 'payable_with' da Fatura; se não, o sistema
     * considerará o 'payable_with' da Assinatura.
     *
     * @var array|string[] $payable_with
     */
    protected array $payable_with;

    /**
     * Caso tenha o 'subscription_id', pode-se enviar o número de créditos a adicionar nessa Assinatura baseada em
     * créditos, quando a Fatura for paga.
     *
     * @var int|null $credits
     */
    protected ?int $credits;

    /**
     * Variáveis Personalizadas
     *
     * @var array|CustomVariable[] $custom_variables
     */
    protected array $custom_variables;

    /**
     * Ativa ou desativa os descontos por pagamento antecipado. Quando true, sobrepõe as configurações de
     * desconto da conta.
     *
     * @var bool|null $early_payment_discount
     */
    protected ?bool $early_payment_discount;

    /** @var array  */
    protected array $early_payment_discounts;

    /**
     * Informações do cliente abaixo "payer" são obrigatórias para a emissão de boletos ou necessárias para seu
     * sistema de antifraude. Para emissão de Pix apenas o "payer.name" é obrigatório.
     *
     * @var Payer|null $payer
     */
    protected ?Payer $payer;

    /**
     * Número único que identifica o pedido de compra. Opcional, ajuda a evitar o pagamento da mesma fatura.
     *
     * @var string|null $orderId
     */
    protected ?string $orderId;

    /**
     * Informação de referência externa, possibilitando a realização de pesquisa.
     *
     * @var string|null $external_reference
     */
    protected ?string $external_reference;

    protected ?int $max_installments_value;

    protected ?string $password;
    protected ?string $soft_descriptor_light;
    protected ?string $pix_qr_code_expires_at;

    /**
     * Lista de splits a serém aplicado nas faturas pagas.
     *
     * Para mais informações sobre com funciona o split por fatura
     * @link https://dev.iugu.com/docs/split-por-fatura-no-cart%C3%A3o-de-cr%C3%A9dito-por-api
     *
     * @var array|Split[] $splits -
     */
    protected array $splits;

    public function itemsItemType(): string
    {
        return Item::class;
    }

    public function payableWithItemType(): string
    {
        return 'string';
    }

    public function customVariablesItemType(): string
    {
        return CustomVariable::class;
    }

    public function getEarlyPaymentDiscountsItemType(): string
    {
        return EarlyPaymentDiscount::class;
    }

    public function splitsItemType(): string
    {
        return Split::class;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getCcEmails(): ?string
    {
        return $this->cc_emails;
    }

    public function getDueDate(): string
    {
        return $this->due_date;
    }

    public function isEnsureWorkdayDueDate(): bool
    {
        return $this->ensure_workday_due_date;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function getReturnUrl(): ?string
    {
        return $this->return_url;
    }

    public function getExpiredUrl(): ?string
    {
        return $this->expired_url;
    }

    public function getNotificationUrl(): ?string
    {
        return $this->notification_url;
    }

    public function getIgnoreCanceledEmail(): ?bool
    {
        return $this->ignore_canceled_email;
    }

    public function getFines(): ?bool
    {
        return $this->fines;
    }

    public function getLatePaymentFine(): ?int
    {
        return $this->late_payment_fine;
    }

    public function getPerDayInterest(): ?bool
    {
        return $this->per_day_interest;
    }

    public function getPerDayInterestValue(): ?int
    {
        return $this->per_day_interest_value;
    }

    public function getPerDayInterestCents(): ?int
    {
        return $this->per_day_interest_cents;
    }

    public function getDiscountCents(): ?int
    {
        return $this->discount_cents;
    }

    public function getCustomerId(): ?string
    {
        return $this->customer_id;
    }

    public function getIgnoreDueEmail(): ?bool
    {
        return $this->ignore_due_email;
    }

    public function getSubscriptionId(): ?string
    {
        return $this->subscription_id;
    }

    public function getPayableWith(): array
    {
        return $this->payable_with;
    }

    public function getCredits(): ?int
    {
        return $this->credits;
    }

    public function getCustomVariables(): array
    {
        return $this->custom_variables;
    }

    public function getEarlyPaymentDiscount(): ?bool
    {
        return $this->early_payment_discount;
    }

    public function getEarlyPaymentDiscounts(): array
    {
        return $this->early_payment_discounts;
    }

    public function getPayer(): ?Payer
    {
        return $this->payer;
    }

    public function getOrderId(): ?string
    {
        return $this->orderId;
    }

    public function getExternalReference(): ?string
    {
        return $this->external_reference;
    }

    public function getSplits(): array
    {
        return $this->splits;
    }

    public function setEmail(string $email): Invoice
    {
        $this->email = $email;
        return $this;
    }

    public function setCcEmails(?string $cc_emails): Invoice
    {
        $this->cc_emails = $cc_emails;
        return $this;
    }

    public function setDueDate(string $due_date): Invoice
    {
        $this->due_date = $due_date;
        return $this;
    }

    public function setEnsureWorkdayDueDate(bool $ensure_workday_due_date): Invoice
    {
        $this->ensure_workday_due_date = $ensure_workday_due_date;
        return $this;
    }

    public function setItems(array $items): Invoice
    {
        $this->items = $items;
        return $this;
    }

    public function setReturnUrl(?string $return_url): Invoice
    {
        $this->return_url = $return_url;
        return $this;
    }

    public function setExpiredUrl(?string $expired_url): Invoice
    {
        $this->expired_url = $expired_url;
        return $this;
    }

    public function setNotificationUrl(?string $notification_url): Invoice
    {
        $this->notification_url = $notification_url;
        return $this;
    }

    public function setIgnoreCanceledEmail(?bool $ignore_canceled_email): Invoice
    {
        $this->ignore_canceled_email = $ignore_canceled_email;
        return $this;
    }

    public function setFines(?bool $fines): Invoice
    {
        $this->fines = $fines;
        return $this;
    }

    public function setLatePaymentFine(?int $late_payment_fine): Invoice
    {
        $this->late_payment_fine = $late_payment_fine;
        return $this;
    }

    public function setPerDayInterest(?bool $per_day_interest): Invoice
    {
        $this->per_day_interest = $per_day_interest;
        return $this;
    }

    public function setPerDayInterestValue(?int $per_day_interest_value): Invoice
    {
        $this->per_day_interest_value = $per_day_interest_value;
        return $this;
    }

    public function setPerDayInterestCents(?int $per_day_interest_cents): Invoice
    {
        $this->per_day_interest_cents = $per_day_interest_cents;
        return $this;
    }

    public function setDiscountCents(?int $discount_cents): Invoice
    {
        $this->discount_cents = $discount_cents;
        return $this;
    }

    public function setCustomerId(?string $customer_id): Invoice
    {
        $this->customer_id = $customer_id;
        return $this;
    }

    public function setIgnoreDueEmail(?bool $ignore_due_email): Invoice
    {
        $this->ignore_due_email = $ignore_due_email;
        return $this;
    }

    public function setSubscriptionId(?string $subscription_id): Invoice
    {
        $this->subscription_id = $subscription_id;
        return $this;
    }

    public function setPayableWith(array $payable_with): Invoice
    {
        $this->payable_with = $payable_with;
        return $this;
    }

    public function setCredits(?int $credits): Invoice
    {
        $this->credits = $credits;
        return $this;
    }

    public function setCustomVariables(array $custom_variables): Invoice
    {
        $this->custom_variables = $custom_variables;
        return $this;
    }

    public function setEarlyPaymentDiscount(?bool $early_payment_discount): Invoice
    {
        $this->early_payment_discount = $early_payment_discount;
        return $this;
    }

    public function setEarlyPaymentDiscounts(array $early_payment_discounts): Invoice
    {
        $this->early_payment_discounts = $early_payment_discounts;
        return $this;
    }

    public function setPayer(?Payer $payer): Invoice
    {
        $this->payer = $payer;
        return $this;
    }

    public function setOrderId(?string $orderId): Invoice
    {
        $this->orderId = $orderId;
        return $this;
    }

    public function setExternalReference(?string $external_reference): Invoice
    {
        $this->external_reference = $external_reference;
        return $this;
    }

    public function setSplits(array $splits): Invoice
    {
        $this->splits = $splits;
        return $this;
    }

    public function setMaxInstallmentsValue(?int $max_installments_value): Invoice
    {
        $this->max_installments_value = $max_installments_value;
        return $this;
    }

    public function getMaxInstallmentsValue(): ?int
    {
        return $this->max_installments_value;
    }

    public function setPassword(?string $password): Invoice
    {
        $this->password = $password;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setSoftDescriptorLight(?string $soft_descriptor_light): Invoice
    {
        $this->soft_descriptor_light = $soft_descriptor_light;
        return $this;
    }

    public function getSoftDescriptorLight(): ?string
    {
        return $this->soft_descriptor_light;
    }

    public function setPixQrCodeExpiresAt(?string $pix_qr_code_expires_at): Invoice
    {
        $this->pix_qr_code_expires_at = $pix_qr_code_expires_at;
        return $this;
    }

    public function getPixQrCodeExpiresAt(): ?string
    {
        return $this->pix_qr_code_expires_at;
    }

    public function jsonSerialize()
    {
        return [
            'email' => $this->email,
            'cc_emails' => $this->cc_emails ?? null,
            'due_date' => $this->due_date ?? Carbon::today()->toDateString(),
            'ensure_workday_due_date' => $this->ensure_workday_due_date ?? false,
            'items' => $this->items ?? [],
            'return_url' => $this->return_url ?? null,
            'expired_url' => $this->expired_url ?? null,
            'notification_url' => $this->notification_url ?? null,
            'ignore_canceled_email' => $this->ignore_canceled_email ?? false,
            'fines' => $this->fines ?? false,
            'late_payment_fine' => $this->late_payment_fine ?? null,
            'per_day_interest' => $this->per_day_interest ?? false,
            'per_day_interest_value' => $this->per_day_interest_value ?? null,
            'per_day_interest_cents' => $this->per_day_interest_cents ?? null,
            'discount_cents' => $this->discount_cents ?? null,
            'customer_id' => $this->customer_id ?? null,
            'ignore_due_email' => $this->ignore_due_email ?? true,
            'subscription_id' => $this->subscription_id ?? null,
            'payable_with' => $this->payable_with ?? ['all'],
            'credits' => $this->credits ?? null,
            'custom_variables' => $this->custom_variables ?? [],
            'early_payment_discount' => $this->early_payment_discount ?? false,
            'early_payment_discounts' => $this->early_payment_discounts ?? [],
            'payer' => $this->payer ?? null,
            'order_id' => $this->orderId ?? null,
            'external_reference' => $this->external_reference ?? null,
            'splits' => $this->splits ?? [],
            'max_installments_value' => $this->max_installments_value ?? null,
            'password' => $this->password ?? null,
            'soft_descriptor_light' => $this->soft_descriptor_light ?? null,
            'pix_qr_code_expires_at' => $this->pix_qr_code_expires_at ?? null,
        ];
    }
}