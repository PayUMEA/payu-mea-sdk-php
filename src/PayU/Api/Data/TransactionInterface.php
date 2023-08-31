<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayU\Api\Data;

/**
 * Interface TransactionInterface
 *
 * A transaction defines the contract of a payment - what is the payment
 * for, who is fulfilling it, and other details.
 *
 * @package PayU\Api\Data
 */
interface TransactionInterface
{
    /**#@+
     * Types of transactions.
     */
    const TYPE_PAYMENT = 'PAYMENT'; // authorize & capture
    const TYPE_RESERVE = 'RESERVE'; // authorize
    const TYPE_CREDIT = 'CREDIT'; // refund
    const TYPE_FINALIZE = 'FINALIZE'; // capture an authorized payment
    const TYPE_RESERVE_CANCEL = 'RESERVE_CANCEL'; // cancel an authorization
    const TYPE_DEBIT_ORDER = 'DEBIT_ORDER'; // Recurring payment
    const TYPE_ONCE_OFF_PAYMENT_AND_DEBIT_ORDER = 'ONCE_OFF_PAYMENT_AND_DEBIT_ORDER'; // debit order with payment
    const TYPE_ONCE_OFF_RESERVE_AND_DEBIT_ORDER = 'ONCE_OFF_RESERVE_AND_DEBIT_ORDER'; // debit order with reserve

    public const STATE_EXPIRED = 'EXPIRED';

    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case.
     */
    /*
     * Transaction reference id.
     */
    const DEMO = 'demo';
    /*
     * Transaction reference id.
     */
    const REFERENCE = 'reference';
    /*
     * Short description of transaction.
     */
    const DESCRIPTION = 'description';
    /*
     * Cart.
     */
    const CART = 'cart';
    /*
     * Total to be paid.
     */
    const TOTAL = 'total';
    /*
     * Fraud management details.
     */
    const FRAUD_SERVICE = 'fraud_service';
    /*
     * Shipping Address information.
     */
    const SHIPPING_INFO = 'shipping_info';
    /*
     * Recurring payment details.
     */
    const RECURRING_PAYMENT = 'recurring_payment';

    /**
     * @return string Demo transaction
     * @package PayU\Api\Data
     */
    public function getDemo(): string;

    /**
     * @return string Transaction reference
     */
    public function getReference(): string;

    /**
     * @return string Short description of transaction (For display on payment page
     * when customer is redirected to gateway)
     */
    public function getDescription(): string;

    /**
     * @return ?CartInterface Cart details
     */
    public function getCart(): ?CartInterface;

    /**
     * @return TotalInterface Total due
     */
    public function getTotal(): TotalInterface;

    /**
     * @return ?FraudServiceInterface Fraud management service data
     */
    public function getFraudService(): ?FraudServiceInterface;

    /**
     * @return ?ShippingAddressInterface Shipping information
     */
    public function getShippingInfo(): ?ShippingAddressInterface;

    /**
     * @return ?RecurringPaymentInterface Recurring payment data
     */
    public function getRecurringPayment(): ?RecurringPaymentInterface;

    /**
     * @param string $demo
     * @return $this
     */
    public function setDemo(string $demo): static;

    /**
     * @param string $reference
     * @return $this
     */
    public function setReference(string $reference): static;

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description): static;

    /**
     * @param CartInterface $cart
     * @return $this
     */
    public function setCart(CartInterface $cart): static;

    /**
     * @param TotalInterface $total
     * @return $this
     */
    public function setTotal(TotalInterface $total): static;

    /**
     * @param FraudServiceInterface $fraudService
     * @return $this
     */
    public function setFraudService(FraudServiceInterface $fraudService): static;

    /**
     * @param ShippingAddressInterface $shippingInfo
     * @return $this
     */
    public function setShippingInfo(ShippingAddressInterface $shippingInfo): static;

    /**
     * @param RecurringPaymentInterface $recurringPayment
     * @return $this
     */
    public function setRecurringPayment(RecurringPaymentInterface $recurringPayment): static;
}
