<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayU\Api\Data;

/**
 * Lets you create, process and manage ebucks payments.
 *
 * @package PayU\Api\Data
 * @api
 */
interface EbucksInterface
{
    const PAYMENT = 'PAYMENT';
    const VALIDATE_OTP = 'VALIDATE_OTP';
    const GENERATE_OTP = 'GENERATE_OTP';
    const RESET_PASSWORD = 'RESET_PASSWORD';
    const AUTHENTICATE_ACCOUNT = 'AUTHENTICATE_ACCOUNT';

    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case.
     */
    /*
     * Action being performed.
     */
    const ACTION = 'action';
    /*
     * The type of action performed (authentication).
     */
    const AUTHENTICATE_ACCOUNT_TYPE = 'authenticate_account_type';
    /*
     * eBucks member's card number.
     */
    const EBUCKS_MEMBER_IDENTIFIER = 'ebucks_member_identifier';
    /*
     * PIN for eBucks card.
     */
    const EBUCKS_PIN = 'ebucks_pin';
    /*
     * The type of action performed (generate OTP).
     */
    const GENERATE_OTP_TYPE = 'generate_otp_type';
    /*
     * Amounts in eBucks.
     */
    const EBUCKS_AMOUNT = 'ebucks_amount';
    /*
     * The type of action performed (reset password).
     */
    const RESET_PASSWORD_TYPE = 'reset_password_type';
    /*
     * The type of action performed (validate OTP).
     */
    const VALIDATE_OTP_TYPE = 'validate_otp_type';
    /*
     * OTP provided by the customer.
     */
    const EBUCKS_OTP = 'ebucks_otp';
    /*
     * eBucks account number
     */
    const EBUCKS_ACCOUNT_NUMBER = 'ebucks_account_number';
    /*
     * eBucks destination account number
     */
    const EBUCKS_DESTINATION = 'ebucks_destination';

    /**
     * @return string The Type of action being performed.
     * Valid types [AUTHENTICATE_ACCOUNT, GENERATE_OTP, RESET_PASSWORD, VALIDATE_OTP]
     */
    public function getAction(): string;

    /**
     * @return string Metadata for identifying the type of action performed.
     */
    public function getAuthenticateAccountType(): string;

    /**
     * @return string eBucks member's card number/Identification.
     */
    public function getEbucksMemberIdentifier(): string;

    /**
     * @return string PIN for the eBucks member card.
     */
    public function getEbucksPin(): string;

    /**
     * @return string Metadata for identifying the type of action performed.
     */
    public function getGenerateOTPType(): string;

    /**
     * @return string Amounts in eBucks
     */
    public function getEbucksAmount(): string;

    /**
     * @return string Metadata for identifying the type of action performed.
     */
    public function getResetPasswordType(): string;

    /**
     * @return string Metadata for identifying the type of action performed.
     */
    public function getValidateOTPType(): string;

    /**
     * @return string OTP provided by the customer.
     */
    public function getEbucksOTP(): string;

    /**
     * @return string
     */
    public function getEbucksAccountNumber(): string;

    /**
     * @return string
     */
    public function getEbucksDestination(): string;

    /**
     * @param string $action
     * @return $this
     */
    public function setAction(string $action): static;

    /**
     * @param string $authenticateAccountType
     * @return $this
     */
    public function setAuthenticateAccountType(string $authenticateAccountType): static;

    /**
     * @param string $ebucksMemberIdentifier
     * @return $this
     */
    public function setEbucksMemberIdentifier(string $ebucksMemberIdentifier): static;

    /**
     * @param string $ebucksPin
     * @return $this
     */
    public function setEbucksPin(string $ebucksPin): static;

    /**
     * @param string $generateOtpType
     * @return $this
     */
    public function setGenerateOtpType(string $generateOtpType): static;

    /**
     * @param string $ebucksAmount
     * @return $this
     */
    public function setEbucksAmount(string $ebucksAmount): static;

    /**
     * @param string $resetPasswordType
     * @return $this
     */
    public function setResetPasswordType(string $resetPasswordType): static;

    /**
     * @param string $validateOtpType
     * @return $this
     */
    public function setValidateOTPType(string $validateOtpType): static;

    /**
     * @param string $ebucksOtp
     * @return $this
     */
    public function setEbucksOTP(string $ebucksOtp): static;

    /**
     * @param string $ebucksAccountNumber
     * @return $this
     */
    public function setEbucksAccountNumber(string $ebucksAccountNumber): static;

    /**
     * @param string $ebucksDestination
     * @return $this
     */
    public function setEbucksDestination(string $ebucksDestination): static;
}
