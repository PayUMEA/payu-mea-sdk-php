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

namespace PayUSdk\Api;

use PayU\Exception\InvalidArgumentException;
use PayUSdk\Model\PayUModel;
use PayU\Validation\JsonValidator;

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
