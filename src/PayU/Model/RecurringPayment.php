<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayU\Api;

use PayU\Api\Data\RecurringPaymentInterface;
use PayU\Framework\AbstractModel;

/**
 * Class RecurringDetails
 *
 * @package PaU\Api
 *
 * @property string recurrences
 * @property string statementDescription
 * @property string managedBy
 * @property string startDate
 * @property string anonymousUser
 * @property string frequency
 * @property string deductionDay
 * @property array callCenterRepId
 * @property string recurringPaymentToken
 */
class RecurringPayment extends AbstractModel implements RecurringPaymentInterface
{
    /**
     * Number of recurrences
     *
     * @param string $recurrences
     * @return $this
     */
    public function setRecurrences(string $recurrences): static
    {
        $this->recurrences = $recurrences;

        return $this;
    }

    /**
     * Number of recurrences
     *
     * @return  string
     */
    public function getRecurrences(): string
    {
        return $this->recurrences;
    }

    /**
     * Debit order statement description
     *
     * @param string $statementDescription
     * @return $this
     */
    public function setStatementDescription(string $statementDescription): static
    {
        $this->statementDescription = $statementDescription;

        return $this;
    }

    /**
     * Debit order statement description
     *
     * @return  string
     */
    public function getStatementDescription(): string
    {
        return $this->statementDescription;
    }

    /**
     * Debit order account management
     * Valid values: [PAYU, MERCHANT]
     *
     * @param string $managedBy
     * @return $this
     */
    public function setManagedBy(string $managedBy): static
    {
        $this->managedBy = $managedBy;

        return $this;
    }

    /**
     * Debit order account management
     * Valid values: [PAYU, MERCHANT]
     *
     * @return  string
     */
    public function getManagedBy(): string
    {
        return $this->managedBy;
    }

    /**
     * Debit order start date. Cannot be a date in the past.
     *
     * @param string $startDate
     * @return $this
     */
    public function setStartDate(string $startDate): static
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Debit order start date. Cannot be a date in the past.
     *
     * @return  string
     */
    public function getStartDate(): string
    {
        return $this->startDate;
    }

    /**
     * Debit order account is anonymous or otherwise
     *
     * @param string $anonymousUser
     * @return $this
     */
    public function setAnonymousUser(string $anonymousUser): static
    {
        $this->anonymousUser = $anonymousUser;

        return $this;
    }

    /**
     * Debit order account is anonymous or otherwise
     *
     * @return  string
     */
    public function getAnonymousUser(): string
    {
        return $this->anonymousUser;
    }

    /**
     * Frequencies of Debit Order
     * Valid values: [MONTHLY, BI_MONTHLY, WEEKLY, DAILY, ANNUALLY]
     *
     * @param string $frequency
     * @return $this
     */
    public function setFrequency(string $frequency): static
    {
        $this->frequency = $frequency;

        return $this;
    }

    /**
     * Frequencies of Debit Order
     * Valid values: [MONTHLY, BI_MONTHLY, WEEKLY, DAILY, ANNUALLY]
     *
     * @return  string
     */
    public function getFrequency(): string
    {
        return $this->frequency;
    }

    /**
     * Day on which Debit Order should be processed.
     * Valid values: [WEEKLY, LAST_DAY_OF_MONTH]
     *
     * @param string $deductionDay
     * @return $this
     */
    public function setDeductionDay(string $deductionDay): static
    {
        $this->deductionDay = $deductionDay;

        return $this;
    }

    /**
     * Day on which Debit Order should be processed.
     * Valid values: [WEEKLY, LAST_DAY_OF_MONTH]
     *
     * @return  string
     */
    public function getDeductionDay(): string
    {
        return $this->deductionDay;
    }

    /**
     * Call center representative Id. Must be set to one of the IDs specified in the merchant config
     * `callcenter.allowed.reps` list. If there are no IDs in the `callcenter.allowed.reps` list the
     * callCenterRepId can be an empty string.
     *
     * @param array $callCenterRepId
     * @return $this
     */
    public function setCallCenterRepIds(array $callCenterRepId): static
    {
        $this->callCenterRepId = $callCenterRepId;

        return $this;
    }

    /**
     * Call center representative Id. Must be set to one of the IDs specified in the merchant config
     * `callcenter.allowed.reps` list. If there are no IDs in the `callcenter.allowed.reps` list the
     * callCenterRepId can be an empty string.
     *
     * @return array
     */
    public function getCallCenterRepIds(): array
    {
        return $this->callCenterRepId;
    }

    /**
     * Token representing the debit order setup.
     *
     * @param string $recurringPaymentToken
     * @return $this
     */
    public function setRecurringPaymentToken(string $recurringPaymentToken): static
    {
        $this->recurringPaymentToken = $recurringPaymentToken;

        return $this;
    }

    /**
     * Token representing the debit order setup.
     *
     * @return string
     */
    public function getRecurringPaymentToken(): string
    {
        return $this->recurringPaymentToken;
    }
}
