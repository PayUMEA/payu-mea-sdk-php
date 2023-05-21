<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayU\Model;

use PayU\Api\Data\DetailsInterface;
use PayU\Api\Data\LookupDataEntryInterface;
use PayU\Framework\AbstractModel;

/**
 * Class LookupDataEntry
 *
 * @package PayU\Model
 */
class LookupDataEntry extends AbstractModel implements LookupDataEntryInterface
{
    /**
     * @param string $key
     * @return $this
     */
    public function setKey(string $key): static
    {
        return $this->setData(LookupDataEntryInterface::KEY, $key);
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->getData(LookupDataEntryInterface::KEY);
    }

    /**
     * JSON string value
     *
     * @param DetailsInterface $value
     * @return $this
     */
    public function setValue($value): static
    {
        return $this->setData(LookupDataEntryInterface::VALUE, $value);
    }

    /**
     * JSON string value
     *
     * @return DetailsInterface
     */
    public function getValue(): DetailsInterface
    {
        return $this->getData(LookupDataEntryInterface::VALUE);
    }
}
