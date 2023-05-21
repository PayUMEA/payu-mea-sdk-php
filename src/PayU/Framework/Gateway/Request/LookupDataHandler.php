<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayU\Framework\Gateway\Request;

use PayU\Api\BuilderInterface;

/**
 * Class LookupDataHandler
 *
 * Lookup transaction data builder
 *
 * @package PayU\Framework\Gateway\Request
 */
class LookupDataHandler implements BuilderInterface
{
    /**
     * @param array $buildSubject
     * @return array
     */
    public function build(array $buildSubject): array
    {
        return [
            'lookupTransactionType' => 'TOKEN',
            'Customfield' => [
                [
                    'key' => 'MerchantUserId',
                    'value' => $buildSubject['subject']->getCustomerId(),
                ],
            ],
        ];
    }
}
