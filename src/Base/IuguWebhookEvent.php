<?php

namespace Iugu\Base;

final class IuguWebhookEvent
{
    const ALL = 'all';
    const CUSTOMER_PAYMENT_METHOD_NEW = 'customer_payment_method.new';
    const INVOICE_CREATED = 'invoice.created';
    const INVOICE_STATUS_CHANGED = 'invoice.status_changed';
    const INVOICE_REFUND = 'invoice.refund';
    const INVOICE_PAYMENT_FAILED = 'invoice.payment_failed';
    const INVOICE_DUNNING_ACTION = 'invoice.dunning_action';
    const INVOICE_DUE = 'invoice.due';
    const INVOICE_INSTALLMENT_RELEASED = 'invoice.installment_released';
    const INVOICE_RELEASED = 'invoice.released';
    const INVOICE_BANK_SLIP_STATUS = 'invoice.bank_slip_status';
    const INVOICE_PARTIALLY_REFUNDED = 'invoice.partially_refunded';
    const INVOICE_REFUND_REVERTED = 'invoice.refund_reverted';
    const INVOICE_REJECTED = 'invoice.rejected';
    const INVOICE_SPLIT_RELEASED = 'invoice.split_released';
    const INVOICE_SPLIT_STATUS_CHANGED = 'invoice.split_status_changed';
    const INVOICE_SPLIT_INSTALLMENT_RELEASED = 'invoice.split_installment_released';
    const SUBSCRIPTION_SUSPENDED = 'subscription.suspended';
    const SUBSCRIPTION_ACTIVATED = 'subscription.activated';
    const SUBSCRIPTION_CREATED = 'subscription.created';
    const SUBSCRIPTION_RENEWED = 'subscription.renewed';
    const SUBSCRIPTION_EXPIRED = 'subscription.expired';
    const SUBSCRIPTION_CHANGED = 'subscription.changed';
    const REFERRALS_VERIFICATION = 'referrals.verification';
    const REFERRALS_BANK_VERIFICATION = 'referrals.bank_verification';
    const TRANSFER_REQUEST_STATUS_CHANGED = 'transfer_request.status_changed';
    const WITHDRAW_REQUEST_CREATED = 'withdraw_request.created';
    const WITHDRAW_REQUEST_STATUS_CHANGED = 'withdraw_request.status_changed';
    const DEPOSIT_PIX_STATUS_CHANGED = 'deposit.pix_status_changed';
    const DEPOSIT_TED_STATUS_CHANGED = 'deposit.ted_status_changed';
    const TRANSFER_REQUEST_PIX_STATUS_CHANGED = 'transfer_request.pix_status_changed';
    const TRANSFER_REQUEST_TED_STATUS_CHANGED = 'transfer_request.ted_status_changed';
    const TRANSFER_REQUEST_REJECTED = 'transfer_request.rejected';
    const TRANSFER_REQUEST_DONE = 'transfer_request.done';
    const TRANSFER_REQUEST_REFUNDED = 'transfer_request.refunded';
    const TRANSFER_REQUEST_PARTIALLY_REFUNDED = 'transfer_request.partially_refunded';
    const PIX_KEY_STATUS_CHANGED = 'pix_key.status_changed';
    const PAYMENT_REQUEST_STATUS_CHANGED = 'payment_request.status_changed';
    const PAYMENT_REQUEST_CREATED = 'payment_request.created';
    const TRANSFER_DEBITED = 'transfer.debited';
    const TRANSFER_CREDITED = 'transfer.credited';
}