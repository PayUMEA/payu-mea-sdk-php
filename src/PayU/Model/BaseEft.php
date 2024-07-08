<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Model;

use PayUSdk\Api\Data\CurrencyInterface;
use PayUSdk\Api\Data\EftInterface;
use PayUSdk\Api\Data\TotalInterface;
use PayUSdk\Framework\AbstractModel;
use PayUSdk\Framework\Formatter;
use PayUSdk\Framework\Validation\NumericValidator;

/**
 * Class BaseEft
 *
 * @package PayU\Amount
 */
class BaseEft extends AbstractModel implements EftInterface
{
    /**
     * @return string
     */
    public function getAmount(): string
    {
        return $this->getData(EftInterface::AMOUNT);
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->getData(EftInterface::TYPE);
    }

    /**
     * @return string
     */
    public function getBankName(): string
    {
        return $this->getData(EftInterface::BANK_NAME);
    }

    /**
     * @return CurrencyInterface
     */
    public function getCurrency(): CurrencyInterface
    {
        return $this->getData(TotalInterface::CURRENCY);
    }

    /**
     * @param float $amount
     * @return $this
     */
    public function setAmount(float $amount): static
    {
        NumericValidator::validate($amount, "Amount");
        $amount = Formatter::formatToPrice($amount, $this->getCurrency()->getCode());

        return $this->setData(EftInterface::AMOUNT, $amount);
    }

    /**
     * @param string $type
     * @return $this
     */
    public function setType(string $type): static
    {
        return $this->setData(EftInterface::TYPE, $type);
    }

    /**
     * @param string $bankName
     * @return $this
     */
    public function setBankName(string $bankName): static
    {
        return $this->setData(EftInterface::BANK_NAME, $bankName);
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
