<?php
/**
 * PayU MEA PHP SDK
 *
 * @copyright  Copyright (c) 2016 PayU
 * @license    http://opensource.org/licenses/LGPL-3.0  Open Software License (LGPL 3.0)
 * @link http://www.payu.co.za
 * @link http://help.payu.co.za/developers
 * @author Kenneth Onah <kenneth@netcraft-devops.com>
 */

namespace PayU\Api;

use PayU\Model\PayUModel;

/**
 * Class EFTBase
 *
 * Lets you create, process and manage EFT based payments.
 *
 * @package PayU\Api
 *
 * @property string amount
 * @property string method
 * @property string type
 * @property string url
 * @property string bankName
 */
class EFTBase extends PayUModel
{
    public const FNB = 'FNB';
    public const ABSA = 'ABSA';
    public const NEDBANK = 'NEDBANK';
    public const STANDARD_BANK = 'STANDARD_BANK';

    /**
     * Eft amounts to pay.
     *
     * @param string $amount
     * @return $this
     */
    public function setAmount(string $amount): static
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Eft amount to pay.
     *
     * @return string
     */
    public function getAmount(): string
    {
        return $this->amount;
    }

    /**
     * Indicates the HTTP method that needs to be implemented, i.e. HTTP GET or HTTP POST
     *
     * @param string $method
     * @return $this
     */
    public function setMethod(string $method): static
    {
        $this->method = $method;

        return $this;
    }

    /**
     * Indicates the HTTP method that needs to be implemented, i.e. HTTP GET or HTTP POST
     *
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * Type of payment
     *
     * @param string $type
     * @return $this
     */
    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Type of payment
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Redirect url. Customer is directed to a web page that provides a list of banks that accepts the
     * EFT Pro product as a payment method
     *
     * @param string $url
     * @return $this
     */
    public function setUrl(string $url): static
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Redirect url. Customer is directed to a web page that provides a list of banks that accepts the
     * EFT Pro product as a payment method
     *
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * Name of customer's bank
     *
     * @param string $bankName
     * @return $this
     */
    public function setBankName(string $bankName): static
    {
        $this->bankName = $bankName;

        return $this;
    }

    /**
     * Name of customer's bank
     *
     * @return string
     */
    public function getBankName(): string
    {
        return $this->bankName;
    }
}
