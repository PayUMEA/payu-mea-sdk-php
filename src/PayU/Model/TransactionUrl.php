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

use InvalidArgumentException;
use PayU\Model\PayUModel;
use PayU\Validation\UrlValidator;

/**
 * Class RedirectUrls
 *
 * Set of redirect URLs.
 *
 * @package PayU\Api
 *
 * @property string returnUrl
 * @property string cancelUrl
 * @property string notifyUrl
 */
class RedirectUrls extends PayUModel
{
    /**
     * Url where the customer would be redirected to after approving the payment
     * Required for Redirect Payment Page
     *
     * @param string $returnUrl
     *
     * @throws InvalidArgumentException
     * @return $this
     */
    public function setReturnUrl($returnUrl)
    {
        UrlValidator::validate($returnUrl, "ReturnUrl");
        $this->returnUrl = $returnUrl;
        return $this;
    }

    /**
     * Url where the customer would be redirected to after approving the payment
     * Required for Redirect Payment Page
     *
     * @return string
     */
    public function getReturnUrl()
    {
        return $this->returnUrl;
    }

    /**
     * Url where the customer would be redirected to after canceling the payment.
     * Required for Redirect Payment Page
     *
     * @param string $cancelUrl
     *
     * @throws InvalidArgumentException
     * @return $this
     */
    public function setCancelUrl($cancelUrl)
    {
        UrlValidator::validate($cancelUrl, "CancelUrl");
        $this->cancelUrl = $cancelUrl;
        return $this;
    }

    /**
     * Url where the customer would be redirected to after canceling the payment
     * Required for Redirect Payment Page
     *
     * @return string
     */
    public function getCancelUrl()
    {
        return $this->returnUrl;
    }

    /**
     * Url where the Instant Payment Notification requests are sent.
     *
     * @param string $notifyUrl
     *
     * @throws InvalidArgumentException
     * @return $this
     */
    public function setNotifyUrl($notifyUrl)
    {
        UrlValidator::validate($notifyUrl, "NotifyUrl");
        $this->notifyUrl = $notifyUrl;
        return $this;
    }

    /**
     * Url where the Instant Payment Notification requests are sent.
     *
     * @return string
     */
    public function getNotifyUrl()
    {
        return $this->notifyUrl;
    }
}
