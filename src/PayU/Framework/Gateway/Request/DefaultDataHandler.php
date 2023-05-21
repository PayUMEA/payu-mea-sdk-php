<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayU\Framework\Gateway\Request;

use PayU\Api\BuilderInterface;
use PayU\Framework\Formatter;

/**
 * Class DefaultDataHandler
 *
 * Default data builder
 *
 * @package PayU\Framework\Gateway\Request
 */
class DefaultDataHandler implements BuilderInterface
{
    /**
     * @param array $buildSubject
     * @return array
     */
    public function build(array $buildSubject): array
    {
        $transaction = $buildSubject['subject']->getTransaction();
        $data = [];

        if ($transaction) {
            $total = $transaction->getTotal();
            $totalDue = Formatter::formatToInteger((float)$total->getAmount());

            $data = [
                'TransactionType' => $buildSubject['subject']->getTransactionType(),
                'AdditionalInformation' => [
                    'merchantReference' => $transaction->getReference()
                ],
                'Basket' => [
                    'currencyCode' => $total->getCurrency()->getCode(),
                    'amountInCents' => $totalDue,
                    'description' => $transaction->getDescription()
                ],
            ];
        }

        return $data;
    }
}
