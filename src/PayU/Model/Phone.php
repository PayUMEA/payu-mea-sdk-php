<?php

/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Model;

use PayUSdk\Api\Data\PhoneInterface;

/**
 * Class Phone
 *
 * @package PayUSdk\Model
 */
class Phone extends PayUModel implements PhoneInterface
{
    /**
     * @return string
     */
    public function getCountryCode(): string
    {
        return $this->getData(PhoneInterface::COUNTRY_CODE);
    }

    /**
     * @return string
     */
    public function getNationalNumber(): string
    {
        return $this->getData(PhoneInterface::NATIONAL_NUMBER);
    }

    /**
     * @return string
     */
    public function getExtension(): string
    {
        return $this->getData(PhoneInterface::EXTENSION);
    }

    /**
     * @param string $countryCode
     * @return $this
     */
    public function setCountryCode(string $countryCode): static
    {
        return $this->setData(PhoneInterface::COUNTRY_CODE, $countryCode);
    }

    /**
     * @param string $nationalNumber
     * @return $this
     */
    public function setNationalNumber(string $nationalNumber): static
    {
        return $this->setData(PhoneInterface::NATIONAL_NUMBER, $nationalNumber);
    }

    /**
     * @param string $extension
     * @return $this
     */
    public function setExtension(string $extension): static
    {
        return $this->setData(PhoneInterface::EXTENSION, $extension);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string)$this->getData(PhoneInterface::NATIONAL_NUMBER);
    }
}
