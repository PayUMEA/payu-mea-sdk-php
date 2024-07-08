<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Framework\Gateway\Request;

use PayUSdk\Api\BuilderInterface;
use PayUSdk\Api\Data\EbucksInterface;
use PayUSdk\Framework\Exception\LocalizedException;
use PayUSdk\Framework\Formatter;
use PayUSdk\Model\PaymentMethod;

/**
 * Class EbucksDataHandler
 *
 * eBucks data builder
 *
 * @package PayUSdk\Framework\Gateway\Request
 */
class EbucksDataHandler implements BuilderInterface
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
        $total = $buildSubject['subject']->getTransaction()->getTotal();

        if (PaymentMethod::TYPE_EBUCKS === $paymentMethod && $customer) {
            $ebucks = $customer->getFundingInstrument()->getEbucks();

            $data = match ($ebucks->getAction()) {
                EbucksInterface::AUTHENTICATE_ACCOUNT => [
                    'Customfield' => [
                        [
                            'key' => 'action',
                            'value' => $ebucks->getAction(),
                        ],
                        [
                            'key' => 'authenticateAccountType',
                            'value' => $ebucks->getAuthenticateAccountType(),
                        ],
                        [
                            'key' => 'ebucksMemberIdentifier',
                            'value' => $ebucks->getEbucksMemberIdentifier(),
                        ],
                        [
                            'key' => 'ebucksPin',
                            'value' => $ebucks->getEbucksPin()
                        ]
                    ],
                ],
                EbucksInterface::GENERATE_OTP => [
                    'Customfield' => [
                        [
                            'key' => 'action',
                            'value' => $ebucks->getAction(),
                        ],
                        [
                            'key' => 'generateOTPType',
                            'value' => $ebucks->getGenerateOtpType(),
                        ],
                        [
                            'key' => 'payUReference',
                            'value' => $ebucks->getPayUReference(),
                        ],
                        [
                            'key' => 'ebucksAmount',
                            'value' => $ebucks->getEbucksAmount()
                        ],
                        [
                            'key' => 'amountInCents',
                            'value' => Formatter::formatToInteger((float)$total->getAmount()),
                        ]
                    ],
                ],
                EbucksInterface::RESET_PASSWORD => [
                    'Customfield' => [
                        [
                            'key' => 'action',
                            'value' => $ebucks->getAction(),
                        ],
                        [
                            'key' => 'authenticateAccountType',
                            'value' => 'EBUCKS',
                        ],
                        [
                            'key' => 'ebucksMemberIdentifier',
                            'value' => $ebucks->getEbucksMemberIdentifier(),
                        ],
                        [
                            'key' => 'ebucksPin',
                            'value' => $ebucks->getEbucksPin()
                        ]
                    ],
                ],
                EbucksInterface::PAYMENT => [
                    'Ebucks' => [
                        'amountInCents' => Formatter::formatToInteger((float)$ebucks->getEbucksAmount()),
                    ],
                    'Customfield' => [
                        [
                            'key' => 'ebucksOtp',
                            'value' => $ebucks->getEbucksOTP(),
                        ],
                        [
                            'key' => 'ebucksAccountNumber',
                            'value' => $ebucks->getEbucksAccountNumber(),
                        ],
                    ],
                ],
                default => throw new LocalizedException('eBucks action not supported'),
            };
        }

        return $data;
    }
}
