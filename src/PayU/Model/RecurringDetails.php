<?php

/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Model;

use PayUSdk\Framework\AbstractModel;

/**
 * Class RecurringDetails
 *
 * @package PayUSdk\Model
 */
class RecurringDetails extends AbstractModel
{
    /**
     * @param string $recurrences
     * @return $this
     */
    public function setRecurrences(string $recurrences): self
    {
        $this->setData('recurrences', $recurrences);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRecurrences(): ?string
    {
        return $this->getData('recurrences');
    }

    /**
     * @param string $statementDescription
     * @return $this
     */
    public function setStatementDescription(string $statementDescription): self
    {
        $this->setData('statement_description', $statementDescription);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getStatementDescription(): ?string
    {
        return $this->getData('statement_description');
    }

    /**
     * @param string $managedBy
     * @return $this
     */
    public function setManagedBy(string $managedBy): self
    {
        $this->setData('managed_by', $managedBy);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getManagedBy(): ?string
    {
        return $this->getData('managed_by');
    }

    /**
     * @param string $startDate
     * @return $this
     */
    public function setStartDate(string $startDate): self
    {
        $this->setData('start_date', $startDate);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getStartDate(): ?string
    {
        return $this->getData('start_date');
    }

    /**
     * @param string $anonymousUser
     * @return $this
     */
    public function setAnonymousUser(string $anonymousUser): self
    {
        $this->setData('anonymous_user', $anonymousUser);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAnonymousUser(): ?string
    {
        return $this->getData('anonymous_user');
    }

    /**
     * @param string $frequency
     * @return $this
     */
    public function setFrequency(string $frequency): self
    {
        $this->setData('frequency', $frequency);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFrequency(): ?string
    {
        return $this->getData('frequency');
    }

    /**
     * @param string $deductionDay
     * @return $this
     */
    public function setDeductionDay(string $deductionDay): self
    {
        $this->setData('deduction_day', $deductionDay);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDeductionDay(): ?string
    {
        return $this->getData('deduction_day');
    }

    /**
     * @param array<int|string, mixed>|string $callCenterRepId
     * @return $this
     */
    public function setCallCenterRepIds(array|string $callCenterRepId): self
    {
        if (is_string($callCenterRepId)) {
            $trimmed = trim($callCenterRepId);
            if (str_starts_with($trimmed, '[') && str_ends_with($trimmed, ']')) {
                $callCenterRepId = trim(substr($trimmed, 1, -1));
            }
        }
        if (!is_array($callCenterRepId)) {
            $callCenterRepId = [$callCenterRepId];
        }
        $this->setData('call_center_rep_id', $callCenterRepId);
        return $this;
    }

    /**
     * @return array<int|string, mixed>|null
     */
    public function getCallCenterRepIds(): ?array
    {
        $val = $this->getData('call_center_rep_id');
        if ($val === null) {
            return null;
        }
        if (!is_array($val)) {
            return [$val];
        }
        return $val;
    }

    /**
     * @param string $recurringPaymentToken
     * @return $this
     */
    public function setRecurringPaymentToken(string $recurringPaymentToken): self
    {
        $this->setData('recurring_payment_token', $recurringPaymentToken);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRecurringPaymentToken(): ?string
    {
        return $this->getData('recurring_payment_token');
    }
}
