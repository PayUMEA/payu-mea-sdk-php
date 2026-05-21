<?php

/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Api\Data;

/**
 * Interface CardInterface
 *
 * A card that is used to pay for a payment transaction.
 *
 * @package PayUSdk\Api\Data
 */
interface CardInterface
{
    public const TYPE_VISA = 'VISA';
    public const TYPE_MASTERCARD = 'MASTERCARD';
    public const TYPE_MAESTRO = 'MAESTRO';
    public const TYPE_DISCOVERYMILES = 'DISCOVERYMILES';

    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case.
     */
    /*
     * Card Id.
     */
    public const ID = 'id';
    /*
     * Type.
     */
    public const TYPE = 'type';
    /*
     * Billing address.
     */
    public const BILLING_ADDRESS = 'billing_address';

    /**
     * @return string Card id
     */
    public function getId(): string;

    /**
     * @return string Card type
     */
    public function getType(): string;

    /**
     * @return AddressInterface Card billing address
     */
    public function getBillingAddress(): AddressInterface;

    /**
     * @param string $id
     * @return $this
     */
    public function setId(string $id): static;

    /**
     * @param string $type
     * @return $this
     */
    public function setType(string $type): static;

    /**
     * @param AddressInterface $address
     * @return $this
     */
    public function setBillingAddress(AddressInterface $address): static;
}
