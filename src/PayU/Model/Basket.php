<?php

/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Model;

use PayUSdk\Api\Data\BasketInterface;

/**
 * Class Tax
 *
 * @package PayUSdk\Model
 */
class Basket extends PayUModel implements BasketInterface
{
    /**
     * @return string
     */
    public function getAmountInCents(): string
    {
        return (string)$this->getData(BasketInterface::AMOUNT_IN_CENTS);
    }

    /**
     * @return string
     */
    public function getCurrencyCode(): string
    {
        return (string)$this->getData(BasketInterface::CURRENCY_CODE);
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return (string)$this->getData(BasketInterface::DESCRIPTION);
    }

    /**
     * @param int $amountInCents
     * @return $this
     */
    public function setAmountInCents(int $amountInCents): static
    {
        return $this->setData(BasketInterface::AMOUNT_IN_CENTS, $amountInCents);
    }

    /**
     * @param $currencyCode
     * @return $this
     */
    public function setCurrencyCode($currencyCode): static
    {
        return $this->setData(BasketInterface::CURRENCY_CODE, $currencyCode);
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description): static
    {
        return $this->setData(BasketInterface::DESCRIPTION, $description);
    }
}
