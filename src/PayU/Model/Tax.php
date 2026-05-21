<?php

/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Model;

use PayUSdk\Framework\AbstractModel;
use PayUSdk\Framework\Formatter;
use PayUSdk\Framework\Validation\NumericValidator;

/**
 * Class Tax
 *
 * @package PayUSdk\Model
 */
class Tax extends AbstractModel
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
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->setData('name', $name);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->getData('name');
    }

    /**
     * @param mixed $percent
     * @return $this
     */
    public function setPercent(mixed $percent): self
    {
        NumericValidator::validate($percent, "Percent");
        $percent = Formatter::formatToPrice($percent);
        $this->setData('percent', $percent);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPercent(): ?string
    {
        return $this->getData('percent');
    }

    /**
     * @param \PayUSdk\Model\Currency $amount
     * @return $this
     */
    public function setAmount(Currency $amount): self
    {
        $this->setData('amount', $amount);
        return $this;
    }

    /**
     * @return \PayUSdk\Model\Currency|null
     */
    public function getAmount(): ?Currency
    {
        return $this->getData('amount');
    }
}
