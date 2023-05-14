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
 * Class CaptureDataHandler
 *
 * Default data builder for capture transactions
 *
 * @package PayU\Framework\Gateway\Request
 */
class CaptureDataHandler implements BuilderInterface
{
    /**
     * @param array $buildSubject
     * @return array
     */
    public function build(array $buildSubject): array
    {
        $transactionType = $buildSubject['subject']->getTransactionType();
        $customer = $buildSubject['subject']->getCustomer();
        $transaction = $buildSubject['subject']->getTransaction();;
        $total = $transaction->getTotal();
        $amount = Formatter::formatToInteger((float)$total->getAmount());
        $payuReference = $buildSubject['subject']->getPayUReference();
        $merchantReference = $buildSubject['subject']->getMerchantReference();

        $data = [
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


        if ($transactionType === TransactionInterface::TYPE_FINALIZE) {
            $paymentMethod = $customer->getPaymentMethod();

            if ($paymentMethod && PaymentMethod::TYPE_CREDITCARD == $paymentMethod) {
                $data = array_merge(
                    $data,
                    [
                        'Creditcard' => [
                            'amountInCents' => $amount
                        ]
                    ]
                );
            }
        }

        return $data;
    }
}
