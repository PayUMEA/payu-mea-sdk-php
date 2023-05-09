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

use PayU\Model\PayUModel;

/**
 * Class LookupData
 *
 * LookupData class contains response from SOAP method call with various `LookupTransactionType`
 * for instance `PAYMENT_METHODS`
 *
 * @package PayU\Api
 *
 * @property \PayU\Api\LookupDataEntry entry
 */
class LookupData extends PayUModel
{
    /**
     * Array of lookup data
     *
     * @param \PayU\Api\LookupDataEntry $entry
     * @return $this
     */
    public function setEntry($entry)
    {
        $this->entry = $entry;
        return $this;
    }

    /**
     * Array of lookup data
     *
     * @return \PayU\Api\LookupDataEntry
     */
    public function getEntry()
    {
        return $this->entry;
    }
}