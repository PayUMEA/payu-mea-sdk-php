<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayU\Model;

use PayU\Api\Data\ShippingAddressInterface;

/**
 * Class ShippingAddress
 *
 * @package PayU\Api
 */
class ShippingAddress extends Address implements ShippingAddressInterface
{
    /**
     * @return string
     */
    public function getRecipientName(): string
    {
        return $this->getData(ShippingAddressInterface::RECIPIENT_NAME);
    }

    /**
     * @return mixed
     */
    public function getShippingId(): mixed
    {
        return $this->getData(ShippingAddressInterface::SHIPPING_ID);
    }

    /**
     * @return string
     */
    public function getShippingMethod(): string
    {
        return $this->getData(ShippingAddressInterface::SHIPPING_METHOD);
    }

    /**
     * @param string $recipientName
     * @return $this
     */
    public function setRecipientName(string $recipientName): static
    {
        return $this->setData(ShippingAddressInterface::RECIPIENT_NAME, $recipientName);
    }

    /**
     * @param int|string $shippingId
     * @return $this
     */
    public function setShippingId(int|string $shippingId): static
    {
        return $this->setData(ShippingAddressInterface::SHIPPING_ID, $shippingId);
    }

    /**
     * @param string $shippingMethod
     * @return $this
     */
    public function setShippingMethod(string $shippingMethod): static
    {
        return $this->setData(ShippingAddressInterface::SHIPPING_METHOD, $shippingMethod);
    }
}
