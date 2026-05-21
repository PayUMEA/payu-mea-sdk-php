<?php

/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Model;

use PayUSdk\Api\Data\CustomFieldsInterface;

/**
 * Class CustomFields
 *
 * CustomFields class contains client key-value pair data,
 *
 * @package PayUSdk\Api
 *
 * @property string $key
 * @property string $value
 */
class CustomFields extends PayUModel implements CustomFieldsInterface
{
    /**
     * @param string $key
     * @return $this
     */
    public function setKey(string $key): static
    {
        return $this->setData(CustomFieldsInterface::KEY, $key);
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return (string)$this->getData(CustomFieldsInterface::KEY);
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function setValue(mixed $value): static
    {
        return $this->setData(CustomFieldsInterface::VALUE, $value);
    }

    /**
     * @return mixed
     */
    public function getValue(): mixed
    {
        return (string)$this->getData(CustomFieldsInterface::VALUE);
    }
}
