<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Model;


use PayUSdk\Api\Data\AddressInterface;
use PayUSdk\Api\Data\PhoneInterface;
use PayUSdk\Framework\AbstractModel;

/**
 * Class Address
 *
 * @package PayUSdk\Model
 */
class Address  extends AbstractModel implements AddressInterface
{
    /**
     * @return string
     */
    public function getLine1(): string
    {
        return $this->getData(AddressInterface::LINE1);
    }

    /**
     * @return string
     */
    public function getLine2(): string
    {
        return $this->getData(AddressInterface::LINE2);
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->getData(AddressInterface::CITY);
    }

    /**
     * @return PhoneInterface
     */
    public function getPhone(): PhoneInterface
    {
        return $this->getData(AddressInterface::PHONE);
    }

    /**
     * @return string
     */
    public function getCountryCode(): string
    {
        return $this->getData(AddressInterface::COUNTRY_CODE);
    }

    /**
     * @return string
     */
    public function getPostalCode(): string
    {
        return $this->getData(AddressInterface::POSTAL_CODE);
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->getData(AddressInterface::STATE);
    }

    /**
     * @param string $line1
     * @return $this
     */
    public function setLine1(string $line1): static
    {
        return $this->setData(AddressInterface::LINE1, $line1);
    }

    /**
     * @param string $line2
     * @return $this
     */
    public function setLine2(string $line2): static
    {
        return $this->setData(AddressInterface::LINE2, $line2);
    }

    /**
     * @param string $city
     * @return $this
     */
    public function setCity(string $city): static
    {
        return $this->setData(AddressInterface::CITY, $city);
    }

    /**
     * @param PhoneInterface $phone
     * @return $this
     */
    public function setPhone(PhoneInterface $phone): static
    {
        return $this->setData(AddressInterface::PHONE, $phone);
    }

    /**
     * @param string $countryCode
     * @return $this
     */
    public function setCountryCode(string $countryCode): static
    {
        return $this->setData(AddressInterface::COUNTRY_CODE, $countryCode);
    }

    /**
     * @param string $postalCode
     * @return $this
     */
    public function setPostalCode(string $postalCode): static
    {
        return $this->setData(AddressInterface::POSTAL_CODE, $postalCode);
    }

    /**
     * @param string $state
     * @return $this
     */
    public function setState(string $state): static
    {
        return $this->setData(AddressInterface::STATE, $state);
    }
}
