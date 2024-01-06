<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Model;

use PayUSdk\Api\Data\RecurringPaymentInterface;
use PayUSdk\Framework\AbstractModel;

/**
 * Class RecurringDetails
 *
 * @package PaU\Api
 */
class RecurringPayment extends AbstractModel implements RecurringPaymentInterface
{
    /**
     * @return string
     */
    public function getRecurrences(): string
    {
        return $this->getData(RecurringPaymentInterface::RECURRENCES);
    }

    /**
     * @return string
     */
    public function getStatementDescription(): string
    {
        return $this->getData(RecurringPaymentInterface::STATEMENT_DESCRIPTION);
    }

    /**
     * @return string
     */
    public function getManagedBy(): string
    {
        return $this->getData(RecurringPaymentInterface::MANAGED_BY);
    }

    /**
     * @return string
     */
    public function getStartDate(): string
    {
        return $this->getData(RecurringPaymentInterface::START_DATE);
    }

    /**
     * @return ?string
     */
    public function getAnonymousUser(): ?string
    {
        return $this->getData(RecurringPaymentInterface::ANONYMOUS_USER);
    }

    /**
     * @return string
     */
    public function getFrequency(): string
    {
        return $this->getData(RecurringPaymentInterface::FREQUENCY);
    }

    /**
     * @return string
     */
    public function getDeductionDay(): string
    {
        return $this->getData(RecurringPaymentInterface::DEDUCTION_DAY);
    }

    /**
     * @return ?array
     */
    public function getCallCenterRepIds(): ?array
    {
        return $this->getData(RecurringPaymentInterface::REPRESENTATIVE_IDS);
    }

    /**
     * Token representing the debit order setup.
     *
     * @return string
     */
    public function getPaymentToken(): string
    {
        return $this->getData(RecurringPaymentInterface::PAYMENT_TOKEN);
    }

    /**
     * @param string $recurrences
     * @return $this
     */
    public function setRecurrences(string $recurrences): static
    {
        return $this->setData(RecurringPaymentInterface::RECURRENCES, $recurrences);
    }

    /**
     * @param string $statementDescription
     * @return $this
     */
    public function setStatementDescription(string $statementDescription): static
    {
        return $this->setData(RecurringPaymentInterface::STATEMENT_DESCRIPTION, $statementDescription);
    }

    /**
     * @param string $managedBy
     * @return $this
     */
    public function setManagedBy(string $managedBy): static
    {
        return $this->setData(RecurringPaymentInterface::MANAGED_BY, $managedBy);
    }

    /**
     * @param string $startDate
     * @return $this
     */
    public function setStartDate(string $startDate): static
    {
        return $this->setData(RecurringPaymentInterface::START_DATE, $startDate);
    }

    /**
     * @param string $anonymousUser
     * @return $this
     */
    public function setAnonymousUser(string $anonymousUser): static
    {
        return $this->setData(RecurringPaymentInterface::ANONYMOUS_USER, $anonymousUser);
    }

    /**
     * @param string $frequency
     * @return $this
     */
    public function setFrequency(string $frequency): static
    {
        return $this->setData(RecurringPaymentInterface::FREQUENCY, $frequency);
    }

    /**
     * @param string $deductionDay
     * @return $this
     */
    public function setDeductionDay(string $deductionDay): static
    {
        return $this->setData(RecurringPaymentInterface::DEDUCTION_DAY, $deductionDay);
    }

    /**
     * @param array $callCenterRepId
     * @return $this
     */
    public function setCallCenterRepIds(array $callCenterRepId): static
    {
        return $this->setData(RecurringPaymentInterface::REPRESENTATIVE_IDS, $callCenterRepId);
    }

    /**
     * @param string $paymentToken
     * @return $this
     */
    public function setPaymentToken(string $paymentToken): static
    {
        return $this->setData(RecurringPaymentInterface::PAYMENT_TOKEN, $paymentToken);
    }
}
