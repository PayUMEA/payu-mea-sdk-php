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
 * Class FundingInstrumentDataHandler
 *
 * Funding instrument data builder
 *
 * @package PayUSdk\Framework\Gateway\Request
 */
class FundingInstrumentDataHandler implements BuilderInterface
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
            $customer = $buildSubject['subject']->getCustomer();
            $fundingInstrument = $customer->getFundingInstrument();
            $saveCard = $fundingInstrument ? $fundingInstrument->getSaveCard() : null;

            if ($saveCard) {
                $data['AdditionalInformation'] = ['storePaymentMethod' => 'true'];
            }

            $cardToken = $fundingInstrument->getCardToken();

            if ($cardToken && !$cardToken->isEmpty()) {
                $transaction = $buildSubject['subject']->getTransaction();
                $total = $transaction->getTotal();
                $totalDue = Formatter::formatToInteger((float)$total->getAmount());

                $data['Creditcard'] = [
                    'amountInCents' => $totalDue,
                    'pmId' => $cardToken->getId(),
                    'cvv' => $cardToken->getCvv()
                ];
                $data['AuthenticationType'] = 'TOKEN';

                if (PaymentMethod::TYPE_REAL_TIME_RECURRING === $customer->getPaymentMethod()) {
                    $data['Customfields'] = [
                        'key' => 'processingType',
                        'value' => PaymentMethod::TYPE_REAL_TIME_RECURRING
                    ];
                }
            }
        }

        return $data;
    }
}
