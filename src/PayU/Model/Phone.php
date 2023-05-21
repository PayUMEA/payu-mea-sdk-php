<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayU\Model;

use PayU\Api\Data\PhoneInterface;
use PayU\Framework\AbstractModel;

/**
 * Class Phone
 *
 * @package PayU\Model
 */
class Phone extends AbstractModel implements PhoneInterface
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
}
