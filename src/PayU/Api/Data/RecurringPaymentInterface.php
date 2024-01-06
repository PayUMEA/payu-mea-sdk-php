<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Api\Data;

/**
 * Interface RecurringPaymentInterface
 *
 * The details of Debit Order payment setup on the customer account
 *
 * @package PayUSdk\Api\Data
 */
interface RecurringPaymentInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case.
     */
    /*
     * Recurring frequency.
     */
    const RECURRENCES = 'recurrences';
    /*
     * Bank statement description.
     */
    const STATEMENT_DESCRIPTION = 'statement_description';
    /*
     * Who manages the recurring payment.
     */
    const MANAGED_BY = 'managed_by';
    /*
     * Start date for recurring payment.
     */
    const START_DATE = 'start_date';
    /*
     * Is user anonymous.
     */
    const ANONYMOUS_USER = 'anonymous_user';
    /*
     * Start date for recurring payment.
     */
    const FREQUENCY = 'frequency';
    /*
     * Day when payment is debited.
     */
    const DEDUCTION_DAY = 'deduction_day';
    /*
     * Call center representative id.
     */
    const REPRESENTATIVE_IDS = 'representative_ids';
    /*
     * Recurring payment token.
     */
    const PAYMENT_TOKEN = 'payment_token';

    /**
     * Number of recurrences
     *
     * @return string
     */
    public function getRecurrences(): string;

    /**
     * Debit order statement description
     *
     * @return string
     */
    public function getStatementDescription(): string;

    /**
     * Debit order account management
     *
     * @return  string
     */
    public function getManagedBy(): string;

    /**
     * Debit order start date. Cannot be a date in the past
     *
     * @return  string
     */
    public function getStartDate(): string;

    /**
     * Debit order account is anonymous or otherwise
     *
     * @return ?string
     */
    public function getAnonymousUser(): ?string;

    /**
     * Frequencies of Debit Order
     * Valid values: [MONTHLY, BI_MONTHLY, WEEKLY, DAILY, ANNUALLY]
     *
     * @return  string
     */
    public function getFrequency(): string;

    /**
     * Day on which Debit Order should be processed.
     * Valid values: [WEEKLY, LAST_DAY_OF_MONTH]
     *
     * @return  string
     */
    public function getDeductionDay(): string;

    /**
     * Call center representative id. Must be set to one of the IDs specified in the merchant config
     * `callcenter.allowed.reps` list. If there are no IDs in the `callcenter.allowed.reps` list the
     * callCenterRepId can be an empty string.
     *
     * @return ?array
     */
    public function getCallCenterRepIds(): ?array;

    /**
     * Token representing the debit order setup.
     *
     * @return string
     */
    public function getPaymentToken(): string;

    /**
     * @param string $recurrences
     * @return $this
     */
    public function setRecurrences(string $recurrences): static;

    /**
     * @param string $statementDescription
     * @return $this
     */
    public function setStatementDescription(string $statementDescription): static;

    /**
     * @param string $managedBy
     * @return $this
     */
    public function setManagedBy(string $managedBy): static;

    /**
     * @param string $startDate
     * @return $this
     */
    public function setStartDate(string $startDate): static;

    /**
     * @param string $anonymousUser
     * @return $this
     */
    public function setAnonymousUser(string $anonymousUser): static;

    /**
     * @param string $frequency
     * @return $this
     */
    public function setFrequency(string $frequency): static;

    /**
     * @param string $deductionDay
     * @return $this
     */
    public function setDeductionDay(string $deductionDay): static;

    /**
     * @param array $callCenterRepId
     * @return $this
     */
    public function setCallCenterRepIds(array $callCenterRepId): static;

    /**
     * @param string $paymentToken
     * @return $this
     */
    public function setPaymentToken(string $paymentToken): static;
}
