<?php

/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Api\Data;

/**
 * Interface PaymentMethodInterface
 *
 * @package PayUSdk\Api\Data
 */
interface PaymentMethodInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case.
     */
    /*
     * Payment Id.
     */
    public const ID = 'id';
    /*
     * Payment Method Token Id.
     */
    public const PM_ID = 'pm_id';
    /*
     * Card PAN number.
     */
    public const CARD_NUMBER = 'card_number';
    /*
     * Card Type Information.
     */
    public const INFORMATION = 'information';
    /*
     * Transaction Amount In Cents.
     */
    public const AMOUNT_IN_CENTS = 'amount_in_cents';
    /*
     * Card Expiry Date.
     */
    public const CARD_EXPIRY = 'card_expiry';
    /*
     * CVV Number.
     */
    public const CVV = 'cvv';
    /*
     * Name On Card.
     */
    public const NAME_ON_CARD = 'name_on_card';
    /*
     * Is Card Verified?.
     */
    public const VERIFIED = 'verified';
    /*
     * Description of payment method set by owner.
     */
    public const DESCRIPTION = 'description';
    /*
     * Default payment method.
     */
    public const DEFAULT_METHOD = 'default_method';
    /*
     * EFT Bank Reference.
     */
    public const REFERENCE = 'reference';
    /*
     * eBucks Token.
     */
    public const EBUCKS_TOKEN = 'ebucks_token';

    /**
     * @return string
     */
    public function getId(): string;

    /**
     * @return string
     */
    public function getPmId(): string;

    /**
     * @return string
     */
    public function getCardNumber(): string;

    /**
     * @return string
     */
    public function getInformation(): string;

    /**
     * @return int
     */
    public function getAmountInCents(): int;

    /**
     * @return string
     */
    public function getCardExpiry(): string;

    /**
     * @return string
     */
    public function getCvv(): string;

    /**
     * @return string
     */
    public function getNameOnCard(): string;

    /**
     * @return bool
     */
    public function isVerified(): bool;

    /**
     * @return mixed
     */
    public function getDefaultPaymentMethod(): mixed;

    /**
     * @return string
     */
    public function getReference(): string;

    /**
     * @return string
     */
    public function getReference(): string;

    /**
     * @return string
     */
    public function getEbucksToken(): string;

    /**
     * @param string $id
     * @return $this
     */
    public function setId(string $id): static;

    /**
     * @param string $pmId
     * @return $this
     */
    public function setPmId(string $pmId): static;

    /**
     * @param string $number
     * @return $this
     */
    public function setCardNumber(string $number): static;

    /**
     * @param string $information
     * @return $this
     */
    public function setInformation(string $information): static;

    /**
     * @param int $amount
     * @return $this
     */
    public function setAmountInCents(int $amount): static;

    /**
     * @param string $expiry
     * @return $this
     */
    public function setCardExpiry(string $expiry): static;

    /**
     * @param string $cvv
     * @return $this
     */
    public function setCvv(string $cvv): static;

    /**
     * @param string $nameOnCard
     * @return $this
     */
    public function setNameOnCard(string $nameOnCard): static;

    /**
     * @param bool $verified
     * @return $this
     */
    public function setVerified(bool $verified): static;

    /**
     * @param mixed $defaultPm
     * @return $this
     */
    public function setDefaultPaymentMethod(mixed $defaultPm): static;

    /**
     * @param string $reference
     * @return $this
     */
    public function setReference(string $reference): static;

    /**
     * @param string $ebucksToken
     * @return $this
     */
    public function setEbucksToken(string $ebucksToken): static;
}
