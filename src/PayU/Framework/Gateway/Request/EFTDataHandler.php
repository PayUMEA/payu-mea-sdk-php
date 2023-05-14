<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayU\Framework\Gateway\Request;

use PayU\Api\BuilderInterface;
use PayU\Api\Data\EbucksInterface;
use PayU\Framework\Exception\LocalizedException;
use PayU\Framework\Formatter;
use PayU\Model\PaymentMethod;

/**
 * Class EFTDataHandler
 *
 * EFT data builder
 *
 * @package PayU\Framework\Gateway\Request
 */
class EFTDataHandler implements BuilderInterface
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
        $funding = $customer ? $customer->getFundingInstrument() : null;
        $eft = $funding ? $funding->getEft() : null;

        if ($eft && PaymentMethod::TYPE_EFT_PRO === $paymentMethod) {
            $data = [
                'AdditionalInformation' => [
                    'supportedPaymentMethods' => PaymentMethod::TYPE_EFT_PRO
                ],
                'Eft' => [
                    'amountInCents' => Formatter::formatToInteger((float)$eft->getAmount())
                ]
            ];
        }

        if ($eft && PaymentMethod::TYPE_SMARTEFT === $paymentMethod) {
            $data = [
                'Eft' => [
                    'bankName' => $eft->getBankName(),
                    'amountInCents' => Formatter::formatToInteger((float)$eft->getAmount())
                ],
            ];
        }

        return $data;
    }
}
