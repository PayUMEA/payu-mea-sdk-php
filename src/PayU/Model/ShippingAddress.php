<?php
/**
 * PayU EMEA PHP SDK
 *
 * @copyright  Copyright (c) 2016 PayU
 * @license    http://opensource.org/licenses/LGPL-3.0  Open Software License (LGPL 3.0)
 * @link       http://www.payu.co.za
 * @link       http://help.payu.co.za/developers
 * @author     Kenneth Onah <kenneth@netcraft-devops.com>
 */

namespace PayU\Api;

/**
 * Class ShippingAddress
 *
 * Extended Address object used as shipping address in a payment.
 *
 * @package PayU\Api
 *
 * @property string recipientName
 */
class ShippingAddress extends Address
{
    /**
     * Name of the recipient at this address.
     *
     * @param string $recipientName
     *
     * @return $this
     */
    public function setRecipientName(string $recipientName): static
    {
        $this->recipientName = $recipientName;

        return $this;
    }

    /**
     * Name of the recipient at this address.
     *
     * @return string
     */
    public function getRecipientName(): string
    {
        return $this->recipientName;
    }
}
