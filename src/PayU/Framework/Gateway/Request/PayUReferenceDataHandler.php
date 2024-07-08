<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Framework\Gateway\Request;

use PayUSdk\Api\BuilderInterface;

/**
 * Class PayUReferenceDataHandler
 *
 * PayU reference data builder
 *
 * @package PayUSdk\Framework\Gateway\Request
 */
class PayUReferenceDataHandler implements BuilderInterface
{
    /**
     * @param array $buildSubject
     * @return array
     */
    public function build(array $buildSubject): array
    {
        $data = [];
        $payUReference = $buildSubject['subject']->getPayUReference();

        if ($payUReference) {
            $data['AdditionalInformation'] = ['payUReference' => $payUReference];
        }

        return $data;
    }
}
