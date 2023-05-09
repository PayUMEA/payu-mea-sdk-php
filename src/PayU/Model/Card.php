<?php
/**
 * PayU PHP SDK Library
 *
 * @copyright  Copyright (c) 2016 PayU
 * @license    http://opensource.org/licenses/LGPL-3.0  Open Software License (LGPL 3.0)
 * @link       http://www.payu.co.za
 * @link       http://help.payu.co.za/developers
 * @author     Kenneth Onah <kenneth@netcraft-devops.com>
 */

namespace PayU\Api;

use PayU\Exception\ConfigurationException;
use PayU\Framework\AbstractModel;
use ReflectionException;

/**
 * Class PaymentCard
 *
 * A payment card that can fund a transaction.
 *
 * @package PayU\Api
 */
class PaymentCard extends AbstractModel
{
    const TYPE_VISA = 'VISA';
    const TYPE_MASTERCARD = 'MASTERCARD';
    const TYPE_MAESTRO = 'MAESTRO';
    const TYPE_DISCOVERYMILES = 'DISCOVERYMILES';

    /**
     * @var string
     */
    protected string $id;

    /**
     * @var string
     */
    protected string $number;

    /**
     * @var string
     */
    protected string $type;

    /**
     * @var string
     */
    protected string $expireMonth;

    /**
     * @var string
     */
    protected string $expireYear;

    /**
     * @var string
     */
    protected string $cvv2;

    /**
     * @var string
     */
    protected string $firstName;

    /**
     * @var string
     */
    protected string $lastName;

    /**
     * @var string
     */
    protected string $billingCountry;

    /**
     * @var string
     */
    protected string $status;

    /**
     * @var string
     */
    protected string $issueNumber;

    /**
     * @var bool
     */
    protected bool $showBudget;

    /**
     * @var bool
     */
    protected bool $secure3D;

    /**
     * @var BillingAddress
     */
    protected BillingAddress $billingAddress;

    /**
     * @param $data
     * @throws ConfigurationException
     * @throws ReflectionException
     */
    public function __construct($data = null)
    {
        parent::__construct($data);

        $this->secure3D = true;
        $this->showBudget = false;
    }

    /**
     * The ID of a credit card to save for later use.
     *
     * @param string $id
     *
     * @return $this
     */
    public function setId(string $id): static
    {
        $this->id = $id;

        return $this;
    }

    /**
     * The ID of a credit card to save for later use.
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * The card number.
     *
     * @param string $number
     *
     * @return $this
     */
    public function setNumber(string $number): static
    {
        $this->number = $number;

        return $this;
    }

    /**
     * The card number.
     *
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * The card type.
     * Valid Values: ["VISA", "DISCOVERYMILES", "MAESTRO",  "MASTERCARD"]
     *
     * @param string $type
     *
     * @return $this
     */
    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * The card type.
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * The two-digit expiry month for the card.
     *
     * @param string $expireMonth
     *
     * @return $this
     */
    public function setExpireMonth(string $expireMonth): static
    {
        $this->expireMonth = $expireMonth;

        return $this;
    }

    /**
     * The two-digit expiry month for the card.
     *
     * @return string
     */
    public function getExpireMonth(): string
    {
        return $this->expireMonth;
    }

    /**
     * The four-digit expiry year for the card.
     *
     * @param string $expireYear
     *
     * @return $this
     */
    public function setExpireYear(string $expireYear): static
    {
        $this->expireYear = $expireYear;

        return $this;
    }

    /**
     * The four-digit expiry year for the card.
     *
     * @return string
     */
    public function getExpireYear(): string
    {
        return $this->expireYear;
    }

    /**
     * The validation code for the card. Supported for payments but not for saving payment cards for future use.
     *
     * @param string $cvv2
     *
     * @return $this
     */
    public function setCvv2(string $cvv2): static
    {
        $this->cvv2 = $cvv2;

        return $this;
    }

    /**
     * The validation code for the card. Supported for payments but not for saving payment cards for future use.
     *
     * @return string
     */
    public function getCvv2(): string
    {
        return $this->cvv2;
    }

    /**
     * The first name of the cardholder.
     *
     * @param string $firstName
     *
     * @return $this
     */
    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * The first name of the cardholder.
     *
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * The last name of the cardholder.
     *
     * @param string $lastName
     *
     * @return $this
     */
    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Alias function to concatenate 'firstName' and 'lastName' properties.
     *
     * @return string
     */
    public function getNameOnCard(): string
    {
        return $this->firstName . ' ' . $this->getLastName();
    }

    /**
     * The last name of the cardholder.
     *
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * The two-letter country code.
     *
     * @param string $billingCountry
     *
     * @return $this
     */
    public function setBillingCountry(string $billingCountry): static
    {
        $this->billingCountry = $billingCountry;

        return $this;
    }

    /**
     * The two-letter country code.
     *
     * @return string
     */
    public function getBillingCountry(): string
    {
        return $this->billingCountry;
    }

    /**
     * The billing address for the card.
     *
     * @param \PayU\Api\Address $billingAddress
     *
     * @return $this
     */
    public function setBillingAddress(Address $billingAddress): static
    {
        $this->billingAddress = $billingAddress;

        return $this;
    }

    /**
     * The billing address for the card.
     *
     * @return BillingAddress
     */
    public function getBillingAddress(): BillingAddress
    {
        return $this->billingAddress;
    }

    /**
     * The issue number.
     *
     * @param string $issueNumber
     *
     * @return $this
     */
    public function setIssueNumber(string $issueNumber): static
    {
        $this->issueNumber = $issueNumber;

        return $this;
    }

    /**
     * The issue number.
     *
     * @return string
     */
    public function getIssueNumber(): string
    {
        return $this->issueNumber;
    }

    /**
     * The state of the funding instrument.
     * Valid Values: ["EXPIRED", "ACTIVE"]
     *
     * @param string $status
     *
     * @return $this
     */
    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    /**
     * The state of the funding instrument.
     *
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * Alias for when card is valid i.e. concatenate expireMonth and expireYear.
     *
     * @return string
     */
    public function getValidUntil(): string
    {
        return $this->expireMonth . $this->expireYear;
    }

    /**
     * The flag provides for budget payment.
     *
     * @param bool $showBudget
     *
     * @return $this
     */
    public function setShowBudget(bool $showBudget): static
    {
        $this->showBudget = $showBudget;

        return $this;
    }

    /**
     * The flag provides for budget payment.
     *
     * @return bool
     */
    public function getShowBudget(): bool
    {
        return $this->showBudget;
    }

    /**
     * Secure 3D authentication. For some charge back risk reduction.
     *
     * @param bool $secure3D
     *
     * @return $this
     */
    public function setSecure3D(bool $secure3D): static
    {
        $this->secure3D = $secure3D;

        return $this;
    }

    /**
     * Secure 3D authentication. For some charge back risk reduction.
     *
     * @return bool
     */
    public function getSecure3D(): bool
    {
        return $this->secure3D;
    }
}
