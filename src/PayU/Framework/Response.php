<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayU\Framework;

use PayU\Api\Data\BasketInterface;
use PayU\Api\Data\LookupDataInterface;
use PayU\Api\Data\Secure3DInterface;
use PayU\Api\ResponseInterface;
use PayU\Model\Secure3D;
use PayU\Model\Basket;
use PayU\Model\LookupData;
use PayU\Model\PaymentMethod;
use PayU\Model\RecurringPayment;

/**
 * Class Response
 *
 * Response class contains response from SOAP method call
 *
 * @package PayU\Framework
 */
class Response extends AbstractModel implements ResponseInterface
{
    /**
     * Checks if transaction is successful
     *
     * @return bool
     */
    public function getSuccessful(): bool
    {
        return $this->getData('successful');
    }

    /**
     * User friendly error display message
     *
     * @return string
     */
    public function getDisplayMessage(): string
    {
        return $this->getData('displayMessage');
    }

    /**
     * PayU unique transaction identifier
     *
     * @return ?string
     */
    public function getPayUReference(): ?string
    {
        return $this->getData('payUReference');
    }

    /**
     * Merchant specified transaction identifier. Maybe unique or otherwise.
     *
     * @return string
     */
    public function getMerchantReference(): string
    {
        return $this->getData('merchantReference');
    }

    /**
     * Result code of transaction
     *
     * @return string
     */
    public function getResultCode(): string
    {
        return $this->getData('resultCode');
    }

    /**
     * Result message of transaction
     *
     * @return string
     */
    public function getResultMessage(): string
    {
        return $this->getData('resultMessage');
    }

    /**
     * Type of transaction
     *
     * @return string
     */
    public function getTransactionType(): string
    {
        return $this->getData('transactionType');
    }

    /**
     * Transaction state
     *
     * @return string
     */
    public function getTransactionState(): string
    {
        return $this->getData('transactionState');
    }

    /**
     * Cart summary
     *
     * @return BasketInterface
     */
    public function getBasket(): BasketInterface
    {
        $basket = $this->getData('basket');

        return new Basket($basket);
    }

    /**
     * Secure 3D
     *
     * @return Secure3DInterface
     */
    public function getSecure3D(): Secure3DInterface
    {
        $secure3d = $this->getData('secure3D');

        return new Secure3D($secure3d);
    }

    /**
     * Payment methods used by user to fund payment
     *
     * @return PaymentMethod
     */
    public function getPaymentMethodsUsed(): PaymentMethod
    {
        $paymentMethodsUsed = $this->getData('paymentMethodsUsed');

        return new PaymentMethod($paymentMethodsUsed);
    }

    /**
     * Debit order recurring payment details
     *
     * @return RecurringPayment
     */
    public function getRecurringDetails(): RecurringPayment
    {
        $recurringDetails = $this->getData('recurringDetails');

        return new RecurringPayment($recurringDetails);
    }

    /**
     * EFT funding instrument details.
     *
     * @return \PayU\Api\BaseEft
     */
    public function getRedirect(): BaseEft
    {
        return $this->redirect;
    }

    /**
     * Fraud management details.
     *
     * @return \PayU\Api\FraudService
     */
    public function getFraud(): FraudService
    {
        return $this->getData('fraud');
    }

    /**
     * Custom key-value pair fields.
     *
     * @return array
     */
    public function getCustomFields(): array
    {
        return $this->getData('customFields');
    }

    /**
     * Key-value pair fields returned from a transaction lookup.
     *
     * @return LookupDataInterface
     */
    public function getLookupData(): LookupDataInterface
    {
        $lookupData = $this->getData('lookupData');

        return new LookupData($lookupData);
    }
}
