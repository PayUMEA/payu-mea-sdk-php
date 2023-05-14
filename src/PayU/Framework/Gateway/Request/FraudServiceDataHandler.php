<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayU\Framework\Gateway\Request;

use PayU\Api\BuilderInterface;
use PayU\Framework\Formatter;

/**
 * Class FraudServiceDataHandler
 *
 * Fraud service data builder
 *
 * @package PayU\Framework\Gateway\Request
 */
class FraudServiceDataHandler implements BuilderInterface
{
    public function build(array $buildSubject): array
    {
        $data = [];
        $transaction = $buildSubject['subject']->getTransaction();
        $fraudService = $transaction ? $transaction->getFraudService() : null;

        if ($fraudService) {
            $data = [
                'Fraud' => [
                    'checkFraudOverride' => $fraudService->getCheckFraudOverride(),
                    'merchantWebsite' => $fraudService->getMerchantWebsite(),
                    'pcFingerPrint' => $fraudService->getPCFingerPrint()
                ],
            ];

            $items = [];
            $cart = $transaction->getCart();
            $itemList = $cart ? $cart->getItems(): null;

            if ($itemList) {
                if (is_array($itemList->getItems())) {
                    foreach ($itemList->getItems() as $item) {
                        $costPrice = $item->getCostPrice();
                        $total = $item->getTotal();
                        $costPrice = Formatter::formatToInteger($costPrice);
                        $total = Formatter::formatToInteger($total);

                        $items[] = [
                            'amount' => $total,
                            'costAmount' => $costPrice,
                            'description' => $item->getName(),
                            'sku' => $item->getSku(),
                            'quantity' => $item->getQuantity()
                        ];
                    }
                }
            }

            $shipping = [];
            $shippingInfo = $transaction->getShippingInfo();

            if ($shippingInfo) {
                $shipping = [
                    'shippingId' => $shippingInfo->getId(),
                    'shippingFirstName' => $shippingInfo->getFirstName(),
                    'shippingLastName' => $shippingInfo->getLastName(),
                    'shippingEmail' => $shippingInfo->getEmail(),
                    'shippingAddress1' => $shippingInfo->getLine1(),
                    'shippingAddress2' => $shippingInfo->getLine2(),
                    'shippingAddressCity' => $shippingInfo->getCity(),
                    'shippingCountryCode' => $shippingInfo->getCountryCode(),
                    'shippingPostCode' => $shippingInfo->getPostalCode(),
                    'shippingMethod' => $shippingInfo->getMethod(),
                    //'shippingPhone' => $shippingInfo->getPhone()
                ];
            }

            if (!empty($items)) {
                $data['Basket'] = ['productLineItem' => $items];
            }

            if (!empty($shipping)) {
                $data['Basket'] = ['shippingDetails' => $shipping];
            }
        }

        return $data;
    }
}
