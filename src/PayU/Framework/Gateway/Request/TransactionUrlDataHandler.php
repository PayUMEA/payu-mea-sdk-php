<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Framework\Gateway\Request;

use PayUSdk\Api\BuilderInterface;

/**
 * Class TransactionUrlDataHandler
 *
 * Transaction url data builder
 *
 * @package PayUSdk\Framework\Gateway\Request
 */
class TransactionUrlDataHandler implements BuilderInterface
{
    /**
     * @param array $buildSubject
     * @return array[]
     */
    public function build(array $buildSubject): array
    {
        $data = [];
        $txnUrl = $buildSubject['subject']->getTransactionUrl();

        if ($txnUrl) {
            $notificationUrl = $txnUrl->getNotificationUrl() ?: '';
            $responseUrl = $txnUrl->getResponseUrl() ?: '';
            $cancelUrl = $txnUrl->getCancelUrl() ?: '';

            $data = [
                'AdditionalInformation' => [
                    'notificationUrl' => $notificationUrl,
                    'returnUrl' => $responseUrl,
                    'cancelUrl' => $cancelUrl
                ]
            ];
        }

        return $data;
    }
}
