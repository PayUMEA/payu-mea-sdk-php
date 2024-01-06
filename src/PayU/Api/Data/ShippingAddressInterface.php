<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Api\Data;

/**
 * Interface ShippingAddressInterface
 *
 * Extended address used as shipping address
 *
 * @package PayUSdk\Api\Data
 */
interface ShippingAddressInterface extends AddressInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case.
     */
    /*
     * Full name of recipient.
     */
    const RECIPIENT_NAME = 'recipient_name';
    /*
     * Shipping method.
     */
    const SHIPPING_ID = 'shipping_id';
    /*
     * Shipping method.
     */
    const SHIPPING_METHOD = 'shipping_method';

    /**
     * @return string Name of recipient.
     */
    public function getRecipientName(): string;

    /**
     * @return mixed
     */
    public function getShippingId(): mixed;


    /**
     * @return string
     */
    public function getShippingMethod(): string;

    /**
     * @param string $recipientName
     * @return $this
     */
    public function setRecipientName(string $recipientName): static;

    /**
     * @param int|string $shippingId
     * @return $this
     */
    public function setShippingId(int|string $shippingId): static;

    /**
     * @param string $shippingMethod
     * @return $this
     */
    public function setShippingMethod(string $shippingMethod): static;
}
