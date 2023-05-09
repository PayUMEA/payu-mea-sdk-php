<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayU\Model;

use PayU\Api\Data\CreditCardInterface;

/**
 * Class CreditCard
 *
 * @package PayU\Model
 */
class CreditCard extends Card implements CreditCardInterface
{
    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->getData(CreditCardInterface::NUMBER);
    }

    /**
     * @return string
     */
    public function getNameOnCard(): string
    {
        return $this->getData(CreditCardInterface::NAME_ON_CARD);
    }

    /**
     * @return string
     */
    public function getExpiryMonth(): string
    {
        return $this->getData(CreditCardInterface::EXPIRY_MONTH);
    }

    /**
     * @return string
     */
    public function getExpiryYear(): string
    {
        return $this->getData(CreditCardInterface::EXPIRY_YEAR);
    }

    /**
     * @return string
     */
    public function getCvv(): string
    {
        return $this->getData(CreditCardInterface::CVV);
    }

    /**
     * @return ?bool
     */
    public function isBudget(): ?bool
    {
        return $this->getData(CreditCardInterface::BUDGET);
    }

    /**
     * @return ?bool
     */
    public function isSecure3d(): ?bool
    {
        return $this->getData(CreditCardInterface::SECURE3D);
    }

    /**
     * @param string $number
     * @return $this
     */
    public function setNumber(string $number): static
    {
        return $this->setData(CreditCardInterface::NUMBER, $number);
    }

    /**
     * @param string $nameOnCard
     * @return $this
     */
    public function setNameOnCard(string $nameOnCard): static
    {
        return $this->setData(CreditCardInterface::NAME_ON_CARD, $nameOnCard);
    }

    /**
     * @param string $expiryMonth
     * @return $this
     */
    public function setExpiryMonth(string $expiryMonth): static
    {
        return $this->setData(CreditCardInterface::EXPIRY_MONTH, $expiryMonth);
    }

    /**
     * @param string $expiryYear
     * @return $this
     */
    public function setExpiryYear(string $expiryYear): static
    {
        return $this->setData(CreditCardInterface::EXPIRY_YEAR, $expiryYear);
    }

    /**
     * @param string $cvv
     * @return $this
     */
    public function setCvv(string $cvv): static
    {
        return $this->setData(CreditCardInterface::CVV, $cvv);
    }

    /**
     * @param bool $budget
     * @return $this
     */
    public function setBudget(bool $budget): static
    {
        return $this->setData(CreditCardInterface::BUDGET, $budget);
    }

    /**
     * @param bool $secure3d
     * @return $this
     */
    public function setSecure3d(bool $secure3d): static
    {
        return $this->setData(CreditCardInterface::SECURE3D, $secure3d);
    }

    /**
     * @return string
     */
    public function validUntil(): string
    {
        return $this->getExpiryMonth() . $this->getExpiryYear();
    }
}
