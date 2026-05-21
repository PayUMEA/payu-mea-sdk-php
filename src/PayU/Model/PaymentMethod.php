<?php

/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Model;

use PayUSdk\Api\Data\PaymentMethodInterface;

/**
 * Class PaymentMethod
 *
 * @package PayUSdk\Model
 */
class PaymentMethod extends PayUModel implements PaymentMethodInterface
{
    public const TYPE_CREDITCARD = 'CREDITCARD';
    public const TYPE_DEBIT_ORDER = 'DEBIT_ORDER';
    public const TYPE_EFT_PRO = 'EFT_PRO';
    public const TYPE_SMARTEFT = 'SMARTEFT';
    public const TYPE_EBUCKS = 'EBUCKS';
    public const TYPE_CREDITCARD_TOKEN = 'CREDITCARD_TOKEN';
    public const TYPE_DISCOVERYMILES = 'DISCOVERYMILES';
    public const TYPE_REAL_TIME_RECURRING = 'REAL_TIME_RECURRING';

    /**
     * The payment method id. This is in the form of a token
     *
     * @param string $id
     * @return $this
     */
    public function setId(string $id): static
    {
        return $this->setData(PaymentMethodInterface::ID, $id);
    }

    /**
     * The payment method id. This is in the form of a token
     *
     * @return string
     */
    public function getId(): string
    {
        $id = $this->getData(PaymentMethodInterface::ID);

        if ($id) {
            return $id;
        }

        return $this->getPmId();
    }

    /**
     * The card number.
     *
     * @param string $number
     * @return $this
     */
    public function setCardNumber(string $number): static
    {
        return $this->setData(PaymentMethodInterface::CARD_NUMBER, $number);
    }

    /**
     * The card PAN number.
     *
     * @return string
     */
    public function getCardNumber(): string
    {
        return $this->getData(PaymentMethodInterface::CARD_NUMBER);
    }

    /**
     * The card type information.
     * Valid Values: ["VISA", "MASTERCARD"]
     *
     * @param string $information
     * @return $this
     */
    public function setInformation(string $information): static
    {
        return $this->setData(PaymentMethodInterface::INFORMATION, $information);
    }

    /**
     * The card type information.
     *
     * @return string
     */
    public function getInformation(): string
    {
        return $this->getData(PaymentMethodInterface::INFORMATION);
    }

    /**
     * Payment amount in integer
     *
     * @param int $amountInCents
     * @return $this
     */
    public function setAmountInCents(int $amountInCents): static
    {
        return $this->setData(PaymentMethodInterface::AMOUNT_IN_CENTS, $amountInCents);
    }

    /**
     * Payment amount in integer
     *
     * @return int
     */
    public function getAmountInCents(): int
    {
        return (int)$this->getData(PaymentMethodInterface::AMOUNT_IN_CENTS);
    }

    /**
     * The expiry date for the card.
     *
     * @param string $expiry
     * @return $this
     */
    public function setCardExpiry(string $expiry): static
    {
        return $this->setData(PaymentMethodInterface::CARD_EXPIRY, $expiry);
    }

    /**
     * The expiry date for the card.
     *
     * @return string
     */
    public function getCardExpiry(): string
    {
        return $this->getData(PaymentMethodInterface::CARD_EXPIRY);
    }

    /**
     * The validation code for the card.
     *
     * @param string $cvv
     * @return $this
     */
    public function setCvv(string $cvv): static
    {
        return $this->setData(PaymentMethodInterface::CVV, $cvv);
    }

    /**
     * The validation code for the card.
     *
     * @return string
     */
    public function getCvv(): string
    {
        return $this->getData(PaymentMethodInterface::CVV);
    }

    /**
     * The full name of the card holder.
     *
     * @param string $name
     *
     * @return $this
     */
    public function setNameOnCard(string $name): static
    {
        return $this->setData(PaymentMethodInterface::NAME_ON_CARD, $name);
    }

    /**
     * The full name of the card holder.
     *
     * @return string
     */
    public function getNameOnCard(): string
    {
        return $this->getData(PaymentMethodInterface::NAME_ON_CARD);
    }

    /**
     * The verified status of the payment method.
     *
     * @param bool $verified
     * @return $this
     */
    public function setVerified(bool $verified): static
    {
        return $this->setData(PaymentMethodInterface::VERIFIED, $verified);
    }

    /**
     * The verified status of the payment method.
     *
     * @return bool
     */
    public function isVerified(): bool
    {
        return $this->getData(PaymentMethodInterface::VERIFIED);
    }

    /**
     * The payment method ID
     *
     * @param string $pmId
     *
     * @return $this
     */
    public function setPmId(string $pmId): static
    {
        return $this->setData(PaymentMethodInterface::PM_ID, $pmId);
    }

    /**
     * The payment method token ID
     *
     * @return string
     */
    public function getPmId(): string
    {
        return $this->getData(PaymentMethodInterface::PM_ID);
    }

    /**
     * The payment method description set by the user
     *
     * @param mixed $description
     * @return $this
     */
    public function setDescription(string $description): static
    {
        return $this->setData(PaymentMethodInterface::DESCRIPTION, $description);
    }

    /**
     * The payment method description set by the user
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->getData(PaymentMethodInterface::DESCRIPTION);
    }

    /**
     * The default payment method
     *
     * @param mixed $defaultPm
     * @return $this
     */
    public function setDefaultPaymentMethod(mixed $defaultPm): static
    {
        return $this->setData(PaymentMethodInterface::DEFAULT_METHOD, $defaultPm);
    }

    /**
     * The default payment method
     *
     * @return mixed
     */
    public function getDefaultPaymentMethod(): mixed
    {
        return $this->getData(PaymentMethodInterface::DEFAULT_METHOD);
    }

    /**
     * EFT funding instrument reference
     *
     * @param string $reference
     * @return $this
     */
    public function setReference(string $reference): static
    {
        return $this->setData(PaymentMethodInterface::REFERENCE, $reference);
    }

    /**
     * EFT funding instrument reference
     *
     * @return string
     */
    public function getReference(): string
    {
        return $this->getData(PaymentMethodInterface::REFERENCE);
    }

    /**
     * eBucks funding instrument token
     *
     * @param mixed $ebucksToken
     * @return $this
     */
    public function setEbucksToken(string $ebucksToken): static
    {
        return $this->setData(PaymentMethodInterface::EBUCKS_TOKEN, $ebucksToken);
    }

    /**
     * eBucks funding instrument token
     *
     * @return string
     */
    public function getEbucksToken(): string
    {
        return $this->getData(PaymentMethodInterface::EBUCKS_TOKEN);
    }
}
