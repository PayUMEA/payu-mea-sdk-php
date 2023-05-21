<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayU\Model;

use PayU\Api\Data\EbucksInterface;
use PayU\Framework\AbstractModel;

/**
 * Class Ebucks
 *
 * @package PayU\Api
 */
class Ebucks extends AbstractModel implements EbucksInterface
{
    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->getData(EbucksInterface::ACTION);
    }

    /**
     * @return string
     */
    public function getAuthenticateAccountType(): string
    {
        return $this->getData(EbucksInterface::AUTHENTICATE_ACCOUNT_TYPE);
    }

    /**
     * @return string
     */
    public function getEbucksMemberIdentifier(): string
    {
        return $this->getData(EbucksInterface::EBUCKS_MEMBER_IDENTIFIER);
    }

    /**
     * @return string
     */
    public function getEbucksPin(): string
    {
        return $this->getData(EbucksInterface::EBUCKS_PIN);
    }

    /**
     * @return string
     */
    public function getGenerateOtpType(): string
    {
        return $this->getData(EbucksInterface::GENERATE_OTP_TYPE);
    }

    /**
     * @return string
     */
    public function getEbucksAmount(): string
    {
        return $this->getData(EbucksInterface::EBUCKS_AMOUNT);
    }

    /**
     * @return string
     */
    public function getResetPasswordType(): string
    {
        return $this->getData(EbucksInterface::RESET_PASSWORD_TYPE);
    }

    /**
     * @return string
     */
    public function getValidateOtpType(): string
    {
        return $this->getData(EbucksInterface::VALIDATE_OTP_TYPE);
    }

    /**
     * @return string
     */
    public function getEbucksOtp(): string
    {
        return $this->getData(EbucksInterface::EBUCKS_OTP);
    }

    /**
     * @return string
     */
    public function getEbucksAccountNumber(): string
    {
        return $this->getData(EbucksInterface::EBUCKS_ACCOUNT_NUMBER);
    }

    /**
     * @return string
     */
    public function getEbucksDestination(): string
    {
        return $this->getData(EbucksInterface::EBUCKS_DESTINATION);
    }

    /**
     * @param string $action
     * @return $this
     */
    public function setAction(string $action): static
    {
        return $this->setData(EbucksInterface::ACTION, $action);
    }

    /**
     * @param string $authenticateAccountType
     * @return $this
     */
    public function setAuthenticateAccountType(string $authenticateAccountType): static
    {
        return $this->setData(EbucksInterface::AUTHENTICATE_ACCOUNT_TYPE, $authenticateAccountType);
    }

    /**
     * @param string $ebucksMemberIdentifier
     * @return $this
     */
    public function setEbucksMemberIdentifier(string $ebucksMemberIdentifier): static
    {
        return $this->setData(EbucksInterface::EBUCKS_MEMBER_IDENTIFIER, $ebucksMemberIdentifier);
    }

    /**
     * @param string $ebucksPin
     * @return $this
     */
    public function setEbucksPin(string $ebucksPin): static
    {
        return $this->setData(EbucksInterface::EBUCKS_PIN, $ebucksPin);
    }

    /**
     * @param string $generateOtpType
     * @return $this
     */
    public function setGenerateOTPType(string $generateOtpType): static
    {
        return $this->setData(EbucksInterface::GENERATE_OTP_TYPE, $generateOtpType);
    }

    /**
     * @param string $ebucksAmount
     * @return $this
     */
    public function setEbucksAmount(string $ebucksAmount): static
    {
        return $this->setData(EbucksInterface::EBUCKS_AMOUNT, $ebucksAmount);
    }

    /**
     * @param string $resetPasswordType
     * @return $this
     */
    public function setResetPasswordType(string $resetPasswordType): static
    {
        return $this->setData(EbucksInterface::RESET_PASSWORD_TYPE, $resetPasswordType);
    }

    /**
     * @param string $validateOtpType
     * @return $this
     */
    public function setValidateOTPType(string $validateOtpType): static
    {
        return $this->setData(EbucksInterface::VALIDATE_OTP_TYPE, $validateOtpType);
    }

    /**
     * @param string $ebucksOtp
     * @return $this
     */
    public function setEbucksOTP(string $ebucksOtp): static
    {
        return $this->setData(EbucksInterface::EBUCKS_OTP, $ebucksOtp);
    }

    /**
     * @param string $ebucksAccountNumber
     * @return $this
     */
    public function setEbucksAccountNumber(string $ebucksAccountNumber): static
    {
        return $this->setData(EbucksInterface::EBUCKS_ACCOUNT_NUMBER, $ebucksAccountNumber);
    }

    /**
     * @param string $ebucksDestination
     * @return $this
     */
    public function setEbucksDestination(string $ebucksDestination): static
    {
        return $this->setData(EbucksInterface::EBUCKS_DESTINATION, $ebucksDestination);
    }
}
