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

use PayU\Api\Data\LookupDataEntryInterface;
use PayU\Framework\AbstractModel;
use PayU\Model\PayUModel;

/**
 * Class LookupDataEntry
 *
 * LookupDataEntry class contains lookup data key-value pair details,
 *
 * @package PayU\Api
 *
 * @property string key
 * @property \PayU\Api\Details value
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
     * @param \PayU\Api\Details $value
     * @return $this
     */
    public function setValue($value)
    {
        return $this->setData(LookupDataEntryInterface::VALUE, $value);
    }

    /**
     * JSON string value
     *
     * @return \PayU\Api\Details
     */
    public function getValue()
    {
        return $this->getData(LookupDataEntryInterface::VALUE);
    }
}
