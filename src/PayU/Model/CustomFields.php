<?php
/**
 * PayU MEA PHP SDK
 *
 * @copyright  Copyright (c) 2016 PayU
 * @license    http://opensource.org/licenses/LGPL-3.0  Open Software License (LGPL 3.0)
 * @link       http://www.payu.co.za
 * @link       http://help.payu.co.za/developers
 * @author     Kenneth Onah <kenneth@netcraft-devops.com>
 */

namespace PayU\Api;

use PayU\Exception\InvalidArgumentException;
use PayU\Model\PayUModel;
use PayU\Validation\JsonValidator;

/**
 * Class CustomFields
 *
 * CustomFields class contains key-value pair details,
 *
 * @package PayU\Api
 *
 * @property string key
 * @property string value
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
        $this->key = $key;

        return $this;
    }

    /**
     * JSON String key
     *
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * JSON string value
     *
     * @param string $value
     * @return $this
     */
    public function setValue(string $value): static
    {
        $this->value = $value;

        return $this;
    }

    /**
     * JSON string value
     *
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }
}
