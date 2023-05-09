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

use PayU\Model\ResourceModel;

/**
 * Class Ebucks
 *
 * Lets you create, process and manage ebucks payments.
 *
 * @package PayU\Api
 *
 * @property string action
 * @property string authenticateAccountType
 * @property string ebucksMemberIdentifier
 * @property string ebucksPin
 * @property string generateOTPType
 * @property string ebucksAmount
 * @property string resetPasswordType
 * @property string validateOTPType
 * @property string ebucksOtp
 * @property string ebucksAccountNumber
 * @property string ebucksDestination
 */
class Ebucks extends ResourceModel
{
    const PAYMENT = 'PAYMENT';
    const VALIDATE_OTP = 'VALIDATE_OTP';
    const GENERATE_OTP = 'GENERATE_OTP';
    const RESET_PASSWORD = 'RESET_PASSWORD';
    const AUTHENTICATE_ACCOUNT = 'AUTHENTICATE_ACCOUNT';

    /**
     * The Type of action being performed.
     * Valid types [AUTHENTICATE_ACCOUNT, GENERATE_OTP, RESET_PASSWORD, VALIDATE_OTP]
     *
     * @param string $action
     * @return $this
     */
    public function setAction(string $action): static
    {
        $this->action = $action;

        return $this;
    }

    /**
     * The Type of action being performed.
     * Valid types [AUTHENTICATE_ACCOUNT, GENERATE_OTP, RESET_PASSWORD, VALIDATE_OTP]
     *
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * Metadata for identifying the type of action performed.
     *
     * @param string $authenticateAccountType
     * @return $this
     */
    public function setAuthenticateAccountType(string $authenticateAccountType): static
    {
        $this->authenticateAccountType = $authenticateAccountType;

        return $this;
    }

    /**
     * Metadata for identifying the type of action performed.
     *
     * @return string
     */
    public function getAuthenticateAccountType(): string
    {
        return $this->authenticateAccountType;
    }

    /**
     * eBucks member's card number/Identification.
     *
     * @param string $ebucksMemberIdentifier
     * @return $this
     */
    public function setEbucksMemberIdentifier(string $ebucksMemberIdentifier): static
    {
        $this->ebucksMemberIdentifier = $ebucksMemberIdentifier;

        return $this;
    }

    /**
     * eBucks member's card number/Identification.
     *
     * @return string
     */
    public function getEbucksMemberIdentifier(): string
    {
        return $this->ebucksMemberIdentifier;
    }

    /**
     * PIN for the eBucks member login.
     *
     * @param string $ebucksPin
     * @return $this
     */
    public function setEbucksPin(string $ebucksPin): static
    {
        $this->ebucksPin = $ebucksPin;

        return $this;
    }

    /**
     * PIN for the eBucks member login.
     *
     * @return string
     */
    public function getEbucksPin(): string
    {
        return $this->ebucksPin;
    }

    /**
     * Metadata for identifying the type of action performed.
     *
     * @param string $generateOTPType
     * @return $this
     */
    public function setGenerateOTPType(string $generateOTPType): static
    {
        $this->generateOTPType = $generateOTPType;

        return $this;
    }

    /**
     * Metadata for identifying the type of action performed.
     *
     * @return string
     */
    public function getGenerateOTPType(): string
    {
        return $this->generateOTPType;
    }

    /**
     * Amounts in eBucks.
     *
     * @param string $ebucksAmount
     * @return $this
     */
    public function setEbucksAmount(string $ebucksAmount): static
    {
        $this->ebucksAmount = $ebucksAmount;

        return $this;
    }

    /**
     * Amount in eBucks.
     *
     * @return string
     */
    public function getEbucksAmount(): string
    {
        return $this->ebucksAmount;
    }

    /**
     * Metadata for identifying the type of action performed.
     *
     * @param string $resetPasswordType
     * @return $this
     */
    public function setResetPasswordType(string $resetPasswordType): static
    {
        $this->resetPasswordType = $resetPasswordType;

        return $this;
    }

    /**
     * Metadata for identifying the type of action performed.
     *
     * @return string
     */
    public function getResetPasswordType(): string
    {
        return $this->resetPasswordType;
    }

    /**
     * Metadata for identifying the type of action performed.
     *
     * @param string $validateOTPType
     * @return $this
     */
    public function setValidateOTPType(string $validateOTPType): static
    {
        $this->validateOTPType = $validateOTPType;

        return $this;
    }

    /**
     * Metadata for identifying the type of action performed.
     *
     * @return string
     */
    public function getValidateOTPType(): string
    {
        return $this->validateOTPType;
    }

    /**
     * OTP provided by the customer.
     *
     * @param string $ebucksOtp
     * @return $this
     */
    public function setEbucksOTP(string $ebucksOtp): static
    {
        $this->ebucksOtp = $ebucksOtp;

        return $this;
    }

    /**
     * OTP provided by the customer.
     *
     * @return string
     */
    public function getEbucksOTP(): string
    {
        return $this->ebucksOtp;
    }

    /**
     * eBucks account number
     *
     * @param string $ebucksAccountNumber
     * @return $this
     */
    public function setEbucksAccountNumber(string $ebucksAccountNumber): static
    {
        $this->ebucksAccountNumber = $ebucksAccountNumber;

        return $this;
    }

    /**
     * eBucks account number.
     *
     * @return string
     */
    public function getEbucksAccountNumber(): string
    {
        return $this->ebucksAccountNumber;
    }

    /**
     * eBucks destination account number
     *
     * @param string $ebucksDestination
     * @return $this
     */
    public function setEbucksDestination(string $ebucksDestination): static
    {
        $this->ebucksDestination = $ebucksDestination;

        return $this;
    }

    /**
     * eBucks destination account number.
     *
     * @return string
     */
    public function getEbucksDestination(): string
    {
        return $this->ebucksDestination;
    }
}
