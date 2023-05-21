<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayU\Model;

use PayU\Api\Data\BasketInterface;
use PayU\Framework\AbstractModel;

/**
 * Class Tax
 *
 * @package PayU\Model
 */
class Basket extends AbstractModel implements BasketInterface
{
    /**
     * @return string
     */
    public function getAmountInCents(): string
    {
        return $this->getData(BasketInterface::AMOUNT_IN_CENTS);
    }

    /**
     * @return string
     */
    public function getCurrencyCode(): string
    {
        return $this->getData(BasketInterface::CURRENCY_CODE);
    }

    /**
     * Basket description
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->getData(BasketInterface::DESCRIPTION);
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
     * Basket description
     *
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description): static
    {
        return $this->setData(BasketInterface::DESCRIPTION, $description);
    }
}
