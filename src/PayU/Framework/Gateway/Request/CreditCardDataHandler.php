<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayU\Framework\Gateway\Request;

use PayU\Api\BuilderInterface;
use PayU\Framework\Formatter;
use PayU\Framework\Soap\Context;
use PayU\Model\PaymentMethod;

/**
 * Class CreditCardDataHandler
 *
 * Credit card data builder
 *
 * @package PayU\Framework\Gateway\Request
 */
class CreditCardDataHandler implements BuilderInterface
{
    /**
     * @param array $buildSubject
     * @return array
     */
    public function build(array $buildSubject): array
    {
        $data = [];
        $customer = $buildSubject['subject']->getCustomer();
        $paymentMethod = $customer ? $customer->getPaymentMethod() : null;
        $integration = $buildSubject['context']->getIntegration();
        $funding  = $customer ? $customer->getFundingInstrument() : null;
        $creditCard = $funding ? $funding->getCreditCard() : null;

        if ($creditCard &&
            $integration === Context::ENTERPRISE &&
            PaymentMethod::TYPE_CREDITCARD === $paymentMethod
        ) {
            $transaction = $buildSubject['subject']->getTransaction();
            $total = $transaction->getTotal();
            $totalDue = Formatter::formatToInteger((float)$total->getAmount());
            $showBudget = $creditCard->isBudget();

            if ($showBudget) {
                $data['AdditionalInformation'] = ['showBudget' => $showBudget];
            }

            $secured3D = $creditCard->isSecure3d();

            if ($secured3D) {
                $data['AdditionalInformation'] = [
                    'secure3d' => 'True',
                    'supportedPaymentMethods' => $paymentMethod
                ];
            }

            $data['Creditcard'] = [
                'amountInCents' => $totalDue,
                'cardExpiry' => $creditCard->validUntil(),
                'cardNumber' => $creditCard->getNumber(),
                'cvv' => $creditCard->getCvv(),
                'nameOnCard' => $creditCard->getNameOnCard()
            ];
            $data['AuthenticationType'] = 'N/A';
        }

        return $data;
    }
}
