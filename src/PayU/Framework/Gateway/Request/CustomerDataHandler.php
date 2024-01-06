<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Framework\Gateway\Request;

use PayUSdk\Api\BuilderInterface;

/**
 * Class CustomerDataHandler
 *
 * Customer data builder
 *
 * @package PayUSdk\Framework\Gateway\Request
 */
class CustomerDataHandler implements BuilderInterface
{
    /**
     * @param array $buildSubject
     * @return array
     */
    public function build(array $buildSubject): array
    {
        $data = [];
        $customer = $buildSubject['subject']->getCustomer();
        $customerDetail = $customer ? $customer->getCustomerDetail() : null;

        if ($customerDetail) {
            $data['Customer'] = [
                'ip' => $customerDetail->getIpAddress(),
                'email' => $customerDetail->getEmail(),
                'mobile' => $customerDetail->getPhone()->getNationalNumber(),
                'lastName' => $customerDetail->getLastName(),
                'firstName' => $customerDetail->getFirstName(),
                'merchantUserId' => $customerDetail->getCustomerId()
            ];
        }

        if ($customerDetail->getRegionalId()) {
            $data['Customer']['regionalId'] = $customerDetail->getRegionalId();
        }

        return $data;
    }
}
