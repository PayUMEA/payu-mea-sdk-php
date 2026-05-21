<?php

/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Model;

use PayUSdk\Framework\AbstractModel;

/**
 * Class ShippingInfo
 *
 * @package PayUSdk\Model
 */
class ShippingInfo extends AbstractModel
{
    /**
     * @param string $id
     * @return $this
     */
    public function setId(string $id): self
    {
        $this->setData('id', $id);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->getData('id');
    }

    /**
     * @param string $firstName
     * @return $this
     */
    public function setFirstName(string $firstName): self
    {
        $this->setData('first_name', $firstName);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->getData('first_name');
    }

    /**
     * @param string $lastName
     * @return $this
     */
    public function setLastName(string $lastName): self
    {
        $this->setData('last_name', $lastName);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->getData('last_name');
    }

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail(string $email): self
    {
        $this->setData('email', $email);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->getData('email');
    }

    /**
     * @param string $businessName
     * @return $this
     */
    public function setBusinessName(string $businessName): self
    {
        $this->setData('business_name', $businessName);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getBusinessName(): ?string
    {
        return $this->getData('business_name');
    }

    /**
     * @param string $phone
     * @return $this
     */
    public function setPhone(string $phone): self
    {
        $this->setData('phone', $phone);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->getData('phone');
    }

    /**
     * @param string $method
     * @return $this
     */
    public function setMethod(string $method): self
    {
        $this->setData('method', $method);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMethod(): ?string
    {
        return $this->getData('method');
    }

    /**
     * @param \PayUSdk\Model\ShippingAddress $shippingAddress
     * @return $this
     */
    public function setShippingAddress(ShippingAddress $shippingAddress): self
    {
        $this->setData('shipping_address', $shippingAddress);
        return $this;
    }

    /**
     * @return \PayUSdk\Model\ShippingAddress|null
     */
    public function getShippingAddress(): ?ShippingAddress
    {
        return $this->getData('shipping_address');
    }

    /**
     * @param \PayUSdk\Model\ShippingCost $shippingCost
     * @return $this
     */
    public function setShippingCost(ShippingCost $shippingCost): self
    {
        $this->setData('shipping_cost', $shippingCost);
        return $this;
    }

    /**
     * @return \PayUSdk\Model\ShippingCost|null
     */
    public function getShippingCost(): ?ShippingCost
    {
        return $this->getData('shipping_cost');
    }
}
