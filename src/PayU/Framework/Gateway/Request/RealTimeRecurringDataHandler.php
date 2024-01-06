<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Framework\Gateway\Request;

use PayUSdk\Api\BuilderInterface;
use PayUSdk\Framework\Formatter;
use PayUSdk\Framework\Soap\Context;
use PayUSdk\Model\PaymentMethod;

/**
 * Class RealTimeRecurringDataHandler
 *
 * Recurring payment data builder
 *
 * @package PayUSdk\Framework\Gateway\Request
 */
class RealTimeRecurringDataHandler implements BuilderInterface
{
    /**
     * @param array $buildSubject
     * @return array
     */
    public function build(array $buildSubject): array
    {
        $data = [];
        $integration = $buildSubject['context']->getIntegration();
        $customer = $buildSubject['subject']->getCustomer();

        if ($integration === Context::ENTERPRISE && $customer) {
            $paymentMethod = $customer->getPaymentMethod();
            $fundingInstrument = $customer->getFundingInstrument();
            $creditCard = $fundingInstrument ? $fundingInstrument->getCreditCard() : null;

            if (PaymentMethod::TYPE_REAL_TIME_RECURRING === $paymentMethod && $creditCard) {
                $secure3D = $creditCard->isSecure3D();

                if ($secure3D) {
                    $data['AdditionalInformation'] = ['secure3D' => 'true'];
                }

                $transaction = $buildSubject['subject']->getTransaction();
                $total = $transaction->getTotal();
                $totalDue = Formatter::formatToInteger((float)$total->getAmount());

                $data['Creditcard'] = [
                    'amountInCents' => $totalDue,
                    'cardExpiry' => $creditCard->validUntil(),
                    'cardNumber' => $creditCard->getNumber(),
                    'cvv' => $creditCard->getCvv(),
                    'nameOnCard' => $creditCard->getNameOnCard()
                ];
                $data['Customfields'] = [
                    'key' => 'processingType',
                    'value' => PaymentMethod::TYPE_REAL_TIME_RECURRING
                ];
                $data['AuthenticationType'] = 'TOKEN';
            }
        }

        return $data;
    }
}
