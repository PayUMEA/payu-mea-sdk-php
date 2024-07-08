<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Framework\Gateway\Request;

use PayUSdk\Api\BuilderInterface;
use PayUSdk\Api\Data\TransactionInterface;
use PayUSdk\Framework\Formatter;
use PayUSdk\Model\PaymentMethod;

/**
 * Class RefundDataHandler
 *
 * Default data builder for refunding a captured transaction
 *
 * @package PayUSdk\Framework\Gateway\Request
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
