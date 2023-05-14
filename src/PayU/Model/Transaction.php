<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayU\Model;

use PayU\Api\Data\CartInterface;
use PayU\Api\Data\FraudServiceInterface;
use PayU\Api\Data\RecurringPaymentInterface;
use PayU\Api\Data\ShippingAddressInterface;
use PayU\Api\Data\TotalInterface;
use PayU\Api\Data\TransactionInterface;
use PayU\Framework\AbstractModel;

/**
 * Class Transaction
 *
 * @package PaU\Model
 */
class Transaction extends AbstractModel implements TransactionInterface
{
    /**
     * @return string
     */
    public function getReference(): string
    {
        return $this->getData(TransactionInterface::REFERENCE);
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->getData(TransactionInterface::DESCRIPTION);
    }

    /**
     * @return ?CartInterface
     */
    public function getCart(): ?CartInterface
    {
        return $this->getData(TransactionInterface::CART);
    }

    /**
     * @return TotalInterface
     */
    public function getTotal(): TotalInterface
    {
        return $this->getData(TransactionInterface::TOTAL);
    }

    /**
     * @return ?FraudServiceInterface
     */
    public function getFraudService(): ?FraudServiceInterface
    {
        return $this->getData(TransactionInterface::FRAUD_SERVICE);
    }

    /**
     * @return ?ShippingAddressInterface
     */
    public function getShippingInfo(): ?ShippingAddressInterface
    {
        return $this->getData(TransactionInterface::SHIPPING_INFO);
    }

    /**
     * @return ?RecurringPaymentInterface
     */
    public function getRecurringPayment(): ?RecurringPaymentInterface
    {
        return $this->getData(TransactionInterface::RECURRING_PAYMENT);
    }

    /**
     * @param string $reference
     * @return $this
     */
    public function setReference(string $reference): static
    {
        return $this->setData(TransactionInterface::REFERENCE, $reference);
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description): static
    {
        return $this->setData(TransactionInterface::DESCRIPTION, $description);
    }

    /**
     * @param CartInterface $cart
     * @return $this
     */
    public function setCart(CartInterface $cart): static
    {
        return $this->setData(TransactionInterface::CART, $cart);
    }

    /**
     * @param TotalInterface $total
     * @return $this
     */
    public function setTotal(TotalInterface $total): static
    {
        return $this->setData(TransactionInterface::TOTAL, $total);
    }

    /**
     * @param FraudServiceInterface $fraudService
     * @return $this
     */
    public function setFraudService(FraudServiceInterface $fraudService): static
    {
        return $this->setData(TransactionInterface::FRAUD_SERVICE, $fraudService);
    }

    /**
     * @param ShippingAddressInterface $shippingInfo
     * @return $this
     */
    public function setShippingInfo(ShippingAddressInterface $shippingInfo): static
    {
        return $this->setData(TransactionInterface::SHIPPING_INFO, $shippingInfo);
    }

    /**
     * @param RecurringPaymentInterface $recurringPayment
     * @return $this
     */
    public function setRecurringPayment(RecurringPaymentInterface $recurringPayment): static
    {
        return $this->setData(TransactionInterface::RECURRING_PAYMENT, $recurringPayment);
    }
}
