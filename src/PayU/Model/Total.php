<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Model;

use PayUSdk\Api\Data\CurrencyInterface;
use PayUSdk\Api\Data\TotalInterface;
use PayUSdk\Framework\AbstractModel;
use PayUSdk\Framework\Formatter;
use PayUSdk\Framework\Validation\NumericValidator;

/**
 * Class Total
 *
 * @package PayUSdk\Model
 */
class Total extends AbstractModel implements TotalInterface
{
    /**
     * @return string
     */
    public function getAmount(): string
    {
        return $this->getData(TotalInterface::AMOUNT);
    }

    /**
     * @return CurrencyInterface
     */
    public function getCurrency(): CurrencyInterface
    {
        return $this->getData(TotalInterface::CURRENCY);
    }

    /**
     * Total amount charged from the payer to the payee. In case of a refund,
     * this is the refunded amount to the original payer from the payee.
     *
     * @param float $amount
     * @return $this
     */
    public function setAmount(float $amount): static
    {
        NumericValidator::validate($amount, "Amount");
        $amount = Formatter::formatToPrice($amount, $this->getCurrency()->getCode());

        return $this->setData(TotalInterface::AMOUNT, $amount);
    }

    /**
     * @param CurrencyInterface $currency
     * @return $this
     */
    public function setCurrency(CurrencyInterface $currency): static
    {
        return $this->setData(TotalInterface::CURRENCY, $currency);
    }
}
