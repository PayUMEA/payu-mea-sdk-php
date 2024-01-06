<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Framework\Gateway\Request;

use PayUSdk\Api\BuilderInterface;
use PayUSdk\Api\Data\TransactionInterface;

/**
 * Class FraudServiceDataHandler
 *
 * Transaction record data builder
 *
 * @package PayUSdk\Framework\Gateway\Request
 */
class TransactionRecordDataHandler implements BuilderInterface
{
    /**
     * @param array $buildSubject
     * @return array
     */
    public function build(array $buildSubject): array
    {
        $data = [];
        $transactionRecord = $buildSubject['subject']->getTransactionRecord();

        if ($transactionRecord &&
            $buildSubject['subject']->getTransactionType() === TransactionInterface::TYPE_DEBIT_ORDER
        ) {
            $data['TransactionRecord'] = [
                'recurrences' => $transactionRecord->getRecurrences(),
                'startDate' => $transactionRecord->getStartDate(),
                'statementDescription' => $transactionRecord->getStatementDescription(),
                'managedBy' => $transactionRecord->getManagedBy(),
                'frequency' => $transactionRecord->getFrequency(),
                'anonymousUser' => $transactionRecord->getAnonymousUser()
            ];
            $callCenterRepIds = $transactionRecord->getCallCenterRepIds();

            if ($callCenterRepIds) {
                $data['AdditionalInformation'] = [
                    'callCenterRepId' => implode(',', $callCenterRepIds)
                ];
            }

        }

        return $data;
    }
}
