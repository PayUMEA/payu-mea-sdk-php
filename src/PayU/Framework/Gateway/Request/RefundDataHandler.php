<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayU\Framework\Gateway\Request;

use PayU\Api\BuilderInterface;
use PayU\Api\Data\TransactionInterface;
use PayU\Framework\Formatter;
use PayU\Model\PaymentMethod;

/**
 * Class RefundDataHandler
 *
 * Default data builder for refunding a captured transaction
 *
 * @package PayU\Framework\Gateway\Request
 */
class RefundDataHandler implements BuilderInterface
{
    /**
     * @param array $buildSubject
     * @return array
     */
    public function build(array $buildSubject): array
    {
        $transactionType = $buildSubject['subject']->getTransactionType();
        $transaction = $buildSubject['subject']->getTransaction();;
        $total = $transaction->getTotal();
        $amount = Formatter::formatToInteger((float)$total->getAmount());
        $payuReference = $buildSubject['subject']->getPayUReference();
        $merchantReference = $buildSubject['subject']->getMerchantReference();

        return [
            'TransactionType' => strtoupper($transactionType),
            'AdditionalInformation' => [
                'merchantReference' => $merchantReference,
                'payUReference' => $payuReference
            ],
            'Basket' => [
                'currencyCode' => $total->getCurrency()->getCode(),
                'amountInCents' => $amount
            ],
        ];
    }
}
