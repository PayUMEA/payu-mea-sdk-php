<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Framework\Gateway\Request;

use PayUSdk\Api\BuilderInterface;
use PayUSdk\Framework\Soap\Context;

/**
 * Class PaymentMethodsDataHandler
 *
 * Supported payment methods data builder
 *
 * @package PayUSdk\Framework\Gateway\Request
 */
class PaymentMethodsDataHandler implements BuilderInterface
{
    /**
     * @param array $buildSubject
     * @return array
     */
    public function build(array $buildSubject): array
    {
        $data = [];
        $accountId = $buildSubject['context']->getAccountId();
        $configHashmap = $buildSubject['context']->getConfigHashmap();
        $payUReference = $buildSubject['subject']->getPayUReference();

        if (!$payUReference) {
            $data['AdditionalInformation'] = [
                'supportedPaymentMethods' => $configHashmap[$accountId . '.payment_methods']
            ];

            $paymentMethods = $data['AdditionalInformation']['supportedPaymentMethods'] ?? '';

            if (is_array($paymentMethods)) {
                $data['AdditionalInformation']['supportedPaymentMethods'] = implode(',', $paymentMethods);
            }
        }

        return $data;
    }
}
