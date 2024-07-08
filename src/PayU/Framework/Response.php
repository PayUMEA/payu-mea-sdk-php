<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Framework;

use PayUSdk\Api\Data\BasketInterface;
use PayUSdk\Api\Data\LookupDataInterface;
use PayUSdk\Api\Data\Secure3DInterface;
use PayUSdk\Api\ResponseInterface;
use PayUSdk\Model\BaseEft;
use PayUSdk\Model\Basket;
use PayUSdk\Model\FraudService;
use PayUSdk\Model\LookupData;
use PayUSdk\Model\PaymentMethod;
use PayUSdk\Model\RecurringPayment;
use PayUSdk\Model\Secure3D;

/**
 * Class Response
 *
 * Response class contains response from SOAP method call
 *
 * @package PayUSdk\Framework
 */
class Response extends AbstractModel implements ResponseInterface
{
    /**
     * Checks if transaction is successful
     *
     * @return ?bool
     */
    public function getSuccessful(): ?bool
    {
        return $this->getData('successful');
    }

    /**
     * User friendly error display message
     *
     * @return ?string
     */
    public function getDisplayMessage(): ?string
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
     * @return ?string
     */
    public function getMerchantReference(): ?string
    {
        return $this->getData('merchantReference');
    }

    /**
     * Result code of transaction
     *
     * @return ?string
     */
    public function getResultCode(): ?string
    {
        return $this->getData('resultCode');
    }

    /**
     * Result message of transaction
     *
     * @return ?string
     */
    public function getResultMessage(): ?string
    {
        return $this->getData('resultMessage');
    }

    /**
     * Type of transaction
     *
     * @return ?string
     */
    public function getTransactionType(): ?string
    {
        return $this->getData('transactionType');
    }

    /**
     * Transaction state
     *
     * @return ?string
     */
    public function getTransactionState(): ?string
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
        $basket = $this->getData('basket') ?? [];

        return new Basket($basket);
    }

    /**
     * Secure 3D
     *
     * @return Secure3DInterface
     */
    public function getSecure3D(): Secure3DInterface
    {
        $secure3d = $this->getData('secure3D') ?? [];

        return new Secure3D($secure3d);
    }

    /**
     * Payment methods used by user to fund payment
     *
     * @return PaymentMethod
     */
    public function getPaymentMethodsUsed(): PaymentMethod
    {
        $paymentMethodsUsed = $this->getData('paymentMethodsUsed') ?? [];

        return new PaymentMethod($paymentMethodsUsed);
    }

    /**
     * Debit order recurring payment details
     *
     * @return RecurringPayment
     */
    public function getRecurringDetails(): RecurringPayment
    {
        $recurringDetails = $this->getData('recurringDetails') ?? [];

        return new RecurringPayment($recurringDetails);
    }

    /**
     * EFT funding instrument details.
     *
     * @return BaseEft
     */
    public function getRedirect(): BaseEft
    {
        $eft = $this->getData('eft') ?? [];

        return new BaseEft($eft);
    }

    /**
     * Fraud management details.
     *
     * @return FraudService
     */
    public function getFraud(): FraudService
    {
        return $this->getData('fraud') ?? [];
    }

    /**
     * Custom key-value pair fields.
     *
     * @return array
     */
    public function getCustomFields(): array
    {
        return $this->getData('customFields') ?? [];
    }

    /**
     * Key-value pair fields returned from a transaction lookup.
     *
     * @return LookupDataInterface
     */
    public function getLookupData(): LookupDataInterface
    {
        $lookupData = $this->getData('lookupData') ?? [];

        return new LookupData($lookupData);
    }

    /**
     * @return array
     */
    public function getPaymentData(): array
    {
        return self::toFlatArray($this->toArray());
    }
}
