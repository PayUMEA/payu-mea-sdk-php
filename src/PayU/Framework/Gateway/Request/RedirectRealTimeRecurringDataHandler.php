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
 * Class RedirectRealTimeRecurringDataHandler
 *
 * Redirect recurring payment data builder
 *
 * @package PayUSdk\Framework\Gateway\Request
 */
class RedirectRealTimeRecurringDataHandler implements BuilderInterface
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

        if ($paymentMethod && PaymentMethod::TYPE_REAL_TIME_RECURRING === $paymentMethod) {
            $data['AdditionalInformation'] = [
                'secure3D' => 'true',
                'supportedPaymentMethods' => PaymentMethod::TYPE_CREDITCARD_TOKEN
            ];
            $data['Customfields'] = [
                'key' => 'processingType',
                'value' => PaymentMethod::TYPE_REAL_TIME_RECURRING
            ];
        }

        return $data;
    }
}
