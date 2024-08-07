<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Model;

use PayUSdk\Framework\AbstractModel;

/**
 * Class PaymentMethod
 *
 * @package PayUSdk\Model
 */
class PaymentMethod extends AbstractModel
{
    const TYPE_CREDITCARD = 'CREDITCARD';
    const TYPE_DEBIT_ORDER = 'DEBIT_ORDER';
    const TYPE_EFT_PRO = 'EFT_PRO';
    const TYPE_SMARTEFT = 'SMARTEFT';
    const TYPE_EBUCKS = 'EBUCKS';
    const TYPE_CREDITCARD_TOKEN = 'CREDITCARD_TOKEN';
    const TYPE_DISCOVERYMILES = 'DISCOVERYMILES';
    const TYPE_REAL_TIME_RECURRING = 'REAL_TIME_RECURRING';

    /**
     * The payment method id. This is in the form of a token
     *
     * @param string $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * The payment method id. This is in the form of a token
     *
     * @return string
     */
    public function getId()
    {
        if ($this->id)
            return $this->id;

        return $this->pmId;
    }

    /**
     * The card number.
     *
     * @param string $number
     *
     * @return $this
     */
    public function setCardNumber($number)
    {
        $this->cardNumber = $number;
        return $this;
    }

    /**
     * The card number.
     *
     * @return string
     */
    public function getCardNumber()
    {
        return $this->cardNumber;
    }

    /**
     * The card type.
     * Valid Values: ["VISA", "MASTERCARD"]
     *
     * @param string $type
     *
     * @return $this
     */
    public function setInformation($type)
    {
        $this->information = $type;
        return $this;
    }

    /**
     * The card type.
     *
     * @return string
     */
    public function getInformation()
    {
        return $this->information;
    }

    /**
     * Payment amount in integer
     *
     * @param $amountInCents
     *
     * @return $this
     */
    public function setAmountInCents($amountInCents)
    {
        $this->amountInCents = $amountInCents;
        return $this;
    }

    /**
     * Payment amount in integer
     *
     * @return string
     */
    public function getAmountInCents()
    {
        return $this->amountInCents;
    }

    /**
     * The expiry date for the card.
     *
     * @param string $expiry
     *
     * @return $this
     */
    public function setCardExpiry($expiry)
    {
        $this->cardExpiry = $expiry;
        return $this;
    }

    /**
     * The expiry date for the card.
     *
     * @return string
     */
    public function getCardExpiry()
    {
        return $this->cardExpiry;
    }

    /**
     * The validation code for the card.
     *
     * @param string $cvv
     *
     * @return $this
     */
    public function setCvv($cvv)
    {
        $this->cvv = $cvv;
        return $this;
    }

    /**
     * The validation code for the card.
     *
     * @return string
     */
    public function getCvv()
    {
        return $this->cvv;
    }

    /**
     * The full name of the card holder.
     *
     * @param string $name
     *
     * @return $this
     */
    public function setNameOnCard($name)
    {
        $this->nameOnCard = $name;
        return $this;
    }

    /**
     * The full name of the card holder.
     *
     * @return string
     */
    public function getNameOnCard()
    {
        return $this->nameOnCard;
    }

    /**
     * The verified status of the payment method.
     *
     * @param string $verified
     *
     * @return $this
     */
    public function setVerified($verified)
    {
        $this->verified = $verified;
        return $this;
    }

    /**
     * The verified status of the payment method.
     *
     * @return string
     */
    public function getVerified()
    {
        return $this->verified;
    }

    /**
     * The payment method ID
     *
     * @param string $pmId
     *
     * @return $this
     */
    public function setPmId($pmId)
    {
        $this->pmId = $pmId;
        return $this;
    }

    /**
     * The payment method ID
     *
     * @return string
     */
    public function getPmId()
    {
        return $this->pmId;
    }

    /**
     * The payment method description set by the user
     *
     * @param $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * The payment method description set by the user
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * The default payment method
     *
     * @param $defaultPM
     *
     * @return $this
     */
    public function setDefaultPM($defaultPM)
    {
        $this->defaultPM = $defaultPM;
        return $this;
    }

    /**
     * The default payment method
     *
     * @return string
     */
    public function getDefaultPM()
    {
        return $this->defaultPM;
    }

    /**
     * EFT funding instrument reference
     *
     * @param $reference
     *
     * @return $this
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
        return $this;
    }

    /**
     * EFT funding instrument reference
     *
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * eBucks funding instrument token
     *
     * @param $ebucksToken
     *
     * @return $this
     */
    public function setEbucksToken($ebucksToken)
    {
        $this->ebucksToken = $ebucksToken;
        return $this;
    }

    /**
     * eBucks funding instrument token
     *
     * @return string
     */
    public function getEbucksToken()
    {
        return $this->ebucksToken;
    }
}

