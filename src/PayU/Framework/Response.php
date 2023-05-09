<?php
/**
 * PayU MEA PHP SDK
 *
 * @copyright  Copyright (c) 2016 PayU
 * @license    http://opensource.org/licenses/LGPL-3.0  Open Software License (LGPL 3.0)
 * @link       http://www.payu.co.za
 * @link       http://help.payu.co.za/developers
 * @author     Kenneth Onah <kenneth@netcraft-devops.com>
 */

declare(strict_types=1);

namespace PayU\Api;

use PayU\Framework\AbstractModel;

/**
 * Class Response
 *
 * Response class contains response from SOAP method call
 *
 * @package PayU\Api
 *
 * @property string displayMessage
 * @property string merchantReference
 * @property string payUReference
 * @property string resultCode
 * @property string resultMessage
 * @property boolean successful
 * @property string transactionType
 * @property string transactionState
 * @property \PayU\Api\Basket basket
 * @property \PayU\Api\Secure3D secure3D
 * @property \PayU\Api\CustomFields[] customFields
 * @property \PayU\Api\LookupData lookupData
 * @property \PayU\Api\PaymentMethod paymentMethodsUsed
 * @property \PayU\Api\RecurringPayment recurringDetails
 * @property \PayU\Api\BaseEft redirect
 * @property \PayU\Api\FraudService fraud
 */
class Response extends AbstractModel
{
    /**
     * Checks if transaction is successful
     *
     * @return bool
     */
    public function getSuccessful(): bool
    {
        return $this->successful;
    }

    /**
     * Checks if transaction is successful
     *
     * @param bool $successful
     */
    public function setSuccessful(bool $successful)
    {
        $this->successful = $successful;
    }

    /**
     * User friendly error display message
     *
     * @return string
     */
    public function getDisplayMessage(): string
    {
        return $this->displayMessage;
    }

    /**
     * User friendly error display message
     *
     * @param string $displayMessage
     */
    public function setDisplayMessage(string $displayMessage)
    {
        $this->displayMessage = $displayMessage;
    }

    /**
     * PayU unique transaction identifier
     *
     * @return string
     */
    public function getPayUReference(): string
    {
        return $this->payUReference;
    }

    /**
     * PayU unique transaction identifier
     *
     * @param $payUReference
     */
    public function setPayUReference($payUReference)
    {
        $this->payUReference = $payUReference;
    }

    /**
     * Merchant specified transaction identifier. Maybe unique or otherwise.
     *
     * @return string
     */
    public function getMerchantReference(): string
    {
        return $this->merchantReference;
    }

    /**
     * Merchant specified transaction identifier. Maybe unique or otherwise.
     *
     * @param string $merchantReference
     * @return $this
     */
    public function setMerchantReference(string $merchantReference): static
    {
        $this->merchantReference = $merchantReference;

        return $this;
    }

    /**
     * Result code of transaction
     *
     * @return string
     */
    public function getResultCode(): string
    {
        return $this->resultCode;
    }

    /**
     * Result code of transaction
     *
     * @param string $resultCode
     * @return $this
     */
    public function setResultCode(string $resultCode): static
    {
        $this->resultCode = $resultCode;

        return $this;
    }

    /**
     * Result message of transaction
     *
     * @return string
     */
    public function getResultMessage(): string
    {
        return $this->resultMessage;
    }

    /**
     * Result message of transaction
     *
     * @param string $resultMessage
     * @return $this
     */
    public function setResultMessage(string $resultMessage): static
    {
        $this->resultMessage = $resultMessage;

        return $this;
    }

    /**
     * Type of transaction
     *
     * @return string
     */
    public function getTransactionType(): string
    {
        return $this->transactionType;
    }

    /**
     * Type of transaction
     *
     * @param string $transactionType
     * @return $this
     */
    public function setTransactionType(string $transactionType): static
    {
        $this->transactionType = $transactionType;

        return $this;
    }

    /**
     * Transaction state
     *
     * @return string
     */
    public function getTransactionState(): string
    {
        return $this->transactionState;
    }

    /**
     * Transaction state
     *
     * @param string $transactionState
     * @return $this
     */
    public function setTransactionState(string $transactionState): static
    {
        $this->transactionState = $transactionState;

        return $this;
    }

    /**
     * Cart summary
     *
     * @return \PayU\Api\Basket
     */
    public function getBasket(): Basket
    {
        return $this->basket;
    }

    /**
     * Cart summary
     *
     * @param Basket $basket
     * @return $this
     */
    public function setBasket(Basket $basket): static
    {
        $this->basket = $basket;

        return $this;
    }

    /**
     * Secure 3D
     *
     * @return \PayU\Api\Secure3D
     */
    public function getSecure3D(): Secure3D
    {
        return $this->secure3D;
    }

    /**
     * Secure 3D
     *
     * @param Secure3D $secure3D
     *
     * @return $this
     */
    public function setSecure3D(Secure3D $secure3D): static
    {
        $this->secure3D = $secure3D;

        return $this;
    }

    /**
     * Payment methods used by user to fund payment
     *
     * @return \PayU\Api\PaymentMethod
     */
    public function getPaymentMethodsUsed(): PaymentMethod
    {
        return $this->paymentMethodsUsed;
    }

    /**
     * Payment methods used by user to fund payment
     *
     * @param PaymentMethod $paymentMethodsUsed
     *
     * @return $this
     */
    public function setPaymentMethodsUsed(PaymentMethod $paymentMethodsUsed): static
    {
        $this->paymentMethodsUsed = $paymentMethodsUsed;

        return $this;
    }

    /**
     * Debit order recurring payment details
     *
     * @return \PayU\Api\RecurringPayment
     */
    public function getRecurringDetails(): RecurringPayment
    {
        return $this->recurringDetails;
    }

    /**
     * Debit order recurring payment details
     *
     * @param $recurringDetails
     */
    public function setRecurringDetails($recurringDetails)
    {
        $this->recurringDetails = $recurringDetails;
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
     * EFT funding instrument details
     *
     * @param $redirect
     */
    public function setRedirect($redirect)
    {
        $this->redirect = $redirect;
    }

    /**
     * Fraud management details.
     *
     * @return \PayU\Api\FraudService
     */
    public function getFraud(): FraudService
    {
        return $this->fraud;
    }

    /**
     * Fraud management details.
     *
     * @param $fraud
     */
    public function setFraud($fraud)
    {
        $this->fraud = $fraud;
    }

    /**
     * Append CustomFields to the list.
     *
     * @param CustomFields $customFields
     * @return $this
     */
    public function addCustomFields(CustomFields $customFields): static
    {
        if (!$this->getCustomFields()) {
            return $this->setCustomFields(array($customFields));
        } else {
            return $this->setCustomFields(
                array_merge($this->getCustomFields(), array($customFields))
            );
        }
    }

    /**
     * Custom key-value pair fields.
     *
     * @return \PayU\Api\CustomFields[]
     */
    public function getCustomFields(): array
    {
        return $this->customFields;
    }

    /**
     * Custom key-value pair fields.
     *
     * @param array $customFields
     */
    public function setCustomFields($customFields): static
    {
        $this->customFields = $customFields;

        return $this;
    }

    /**
     * Remove CustomFields from the list.
     *
     * @param CustomFields $customFields
     * @return $this
     */
    public function removeCustomFields(CustomFields $customFields): static
    {
        return $this->setCustomFields(
            array_diff($this->getCustomFields(), array($customFields))
        );
    }

    /**
     * Key-value pair fields returned from a transaction lookup.
     *
     * @return \PayU\Api\LookupData
     */
    public function getLookupData(): LookupData
    {
        return $this->lookupData;
    }

    /**
     * Key-value pair fields returned from a transaction lookup.
     *
     * @param LookupData $lookupData
     */
    public function setLookupData(LookupData $lookupData)
    {
        $this->lookupData = $lookupData;
    }
}
