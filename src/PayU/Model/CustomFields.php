<?php

/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Model;

use PayUSdk\Model\PayUModel;

/**
 * Class CustomFields
 *
 * CustomFields class contains key-value pair details,
 *
 * @package PayUSdk\Api
 *
 * @property string $key
 * @property string $value
 */
class CustomFields extends PayUModel
{
    /**
     * JSON String key
     *
     * @param string $key
     * @return $this
     */
    public function setKey(string $key): static
    {
        return $this->setData('key', $key);
    }

    /**
     * JSON String key
     *
     * @return string
     */
    public function getKey(): string
    {
        return (string)$this->getData('key');
    }

    /**
     * JSON string value
     *
     * @param string $value
     * @return $this
     */
    public function setValue(string $value): static
    {
        return $this->setData('value', $value);
    }

    /**
     * JSON string value
     *
     * @return string
     */
    public function getValue(): string
    {
        return (string)$this->getData('value');
    }
}
