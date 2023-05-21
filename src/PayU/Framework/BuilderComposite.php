<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayU\Framework;

use PayU\Api\BuilderInterface;
use PayU\Framework\Exception\LocalizedException;
use PayU\Framework\Gateway\Request\CaptureDataHandler;
use PayU\Framework\Gateway\Request\CreditCardDataHandler;
use PayU\Framework\Gateway\Request\CustomerDataHandler;
use PayU\Framework\Gateway\Request\DefaultDataHandler;
use PayU\Framework\Gateway\Request\EbucksDataHandler;
use PayU\Framework\Gateway\Request\EFTDataHandler;
use PayU\Framework\Gateway\Request\FraudServiceDataHandler;
use PayU\Framework\Gateway\Request\FundingInstrumentDataHandler;
use PayU\Framework\Gateway\Request\LookupDataHandler;
use PayU\Framework\Gateway\Request\PaymentMethodsDataHandler;
use PayU\Framework\Gateway\Request\PayUReferenceDataHandler;
use PayU\Framework\Gateway\Request\RealTimeRecurringDataHandler;
use PayU\Framework\Gateway\Request\RedirectRealTimeRecurringDataHandler;
use PayU\Framework\Gateway\Request\RefundDataHandler;
use PayU\Framework\Gateway\Request\TransactionRecordDataHandler;
use PayU\Framework\Gateway\Request\TransactionUrlDataHandler;
use PayU\Framework\Gateway\Request\VoidDataHandler;

/**
 * Class BuilderComposite
 *
 * Build request payload
 *
 * @package PayU\Framework
 */
class BuilderComposite implements BuilderInterface
{
    /**
     * @var BuilderInterface[]
     */
    private array $builders = [
        'sale' => [
            'default' => DefaultDataHandler::class,
            'url' => TransactionUrlDataHandler::class,
            'customer' => CustomerDataHandler::class,
            'fraud' => FraudServiceDataHandler::class,
            'record' => TransactionRecordDataHandler::class,
            'payment_methods' => PaymentMethodsDataHandler::class,
            'eft' => EFTDataHandler::class,
            'ebucks' => EbucksDataHandler::class,
            'credit_card' => CreditCardDataHandler::class,
            'funding' => FundingInstrumentDataHandler::class,
            'realtime_recurring' => RealTimeRecurringDataHandler::class,
        ],
        'authorize' => [
            'default' => DefaultDataHandler::class,
            'url' => TransactionUrlDataHandler::class,
            'customer' => CustomerDataHandler::class,
            'fraud' => FraudServiceDataHandler::class,
            'record' => TransactionRecordDataHandler::class,
            'payment_methods' => PaymentMethodsDataHandler::class,
            'credit_card' => CreditCardDataHandler::class,
            'funding' => FundingInstrumentDataHandler::class,
        ],
        'capture' => [
            'default' => CaptureDataHandler::class,
        ],
        'refund' => [
            'default' => RefundDataHandler::class,
        ],
        'void' => [
            'default' => VoidDataHandler::class,
        ],
        'setup' => [
            'default' => DefaultDataHandler::class,
            'url' => TransactionUrlDataHandler::class,
            'customer' => CustomerDataHandler::class,
            'payment_methods' => PaymentMethodsDataHandler::class,
            'fraud' => FraudServiceDataHandler::class,
            'redirect_recurring' => RedirectRealTimeRecurringDataHandler::class,
            'record' => TransactionRecordDataHandler::class,
        ],
        'search' => [
            'payu_reference' => PayUReferenceDataHandler::class,
        ],
        'lookup' => [
            'payload' => LookupDataHandler::class
        ]
    ];

    /**
     * @param array $builders
     */
    public function __construct(
        array $builders = []
    )
    {
        $this->builders = $this->builders + $builders;
    }

    /**
     * Builds request data
     *
     * @param array $buildSubject
     * @return array
     */
    public function build(array $buildSubject): array
    {
        $result = [];
        $builders = $this->builders[$buildSubject['action']] ?? throw new LocalizedException(
            "No data handler found for {$buildSubject['action']} transaction."
        );
        $builders = $this->createDataBuilders($builders);

        foreach ($builders as $builder) {
            // @TODO implement exceptions catching
            $result = $this->merge($result, $builder->build($buildSubject));
        }

        return $result;
    }

    /**
     * Merge function for builders
     *
     * @param array $result
     * @param array $builder
     * @return array
     */
    protected function merge(array $result, array $builder): array
    {
        return array_replace_recursive($result, $builder);
    }

    /**
     * @param array $builders
     * @return array
     */
    protected function createDataBuilders(array $builders): array
    {
        $builderInstances = [];

        foreach ($builders as $label => $builder) {
            if (!is_a($builder, BuilderInterface::class, true)) {
                throw new LocalizedException("$builder must implement BuilderInterface");
            }

            $builderInstances[$label] = new $builder();
        }

        return $builderInstances;
    }
}
