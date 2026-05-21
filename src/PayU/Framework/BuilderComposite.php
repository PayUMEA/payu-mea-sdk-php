<?php

/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Framework;

use PayUSdk\Api\BuilderInterface;
use PayUSdk\Framework\Exception\LocalizedException;
use PayUSdk\Framework\Gateway\Request\CaptureDataHandler;
use PayUSdk\Framework\Gateway\Request\CreditCardDataHandler;
use PayUSdk\Framework\Gateway\Request\CustomerDataHandler;
use PayUSdk\Framework\Gateway\Request\DefaultDataHandler;
use PayUSdk\Framework\Gateway\Request\EbucksDataHandler;
use PayUSdk\Framework\Gateway\Request\EFTDataHandler;
use PayUSdk\Framework\Gateway\Request\FraudServiceDataHandler;
use PayUSdk\Framework\Gateway\Request\FundingInstrumentDataHandler;
use PayUSdk\Framework\Gateway\Request\LookupDataHandler;
use PayUSdk\Framework\Gateway\Request\PaymentMethodsDataHandler;
use PayUSdk\Framework\Gateway\Request\PayUReferenceDataHandler;
use PayUSdk\Framework\Gateway\Request\RealTimeRecurringDataHandler;
use PayUSdk\Framework\Gateway\Request\RedirectRealTimeRecurringDataHandler;
use PayUSdk\Framework\Gateway\Request\RefundDataHandler;
use PayUSdk\Framework\Gateway\Request\TransactionRecordDataHandler;
use PayUSdk\Framework\Gateway\Request\TransactionUrlDataHandler;
use PayUSdk\Framework\Gateway\Request\VoidDataHandler;

/**
 * Class BuilderComposite
 *
 * Build request payload
 *
 * @package PayUSdk\Framework
 */
class BuilderComposite implements BuilderInterface
{
    /**
     * @var array<string, array<string, string>>
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
     * @param array<string, array<string, string>> $builders
     */
    public function __construct(
        array $builders = []
    ) {
        $this->builders = array_merge($this->builders, $builders);
    }

    /**
     * Builds request data
     *
     * @param array<string, mixed> $buildSubject
     * @return array<string, mixed>
     */
    public function build(array $buildSubject): array
    {
        $result = [];
        $buildersConfig = $this->builders[$buildSubject['action']] ?? throw new LocalizedException(
            "No data handler found for {$buildSubject['action']} transaction."
        );
        $builders = $this->createDataBuilders($buildersConfig);

        foreach ($builders as $builder) {
            // @TODO implement exceptions catching
            $result = $this->merge($result, $builder->build($buildSubject));
        }

        return $result;
    }

    /**
     * Merge function for builders
     *
     * @param array<string, mixed> $result
     * @param array<string, mixed> $builder
     * @return array<string, mixed>
     */
    protected function merge(array $result, array $builder): array
    {
        return array_replace_recursive($result, $builder);
    }

    /**
     * @param array<string, string> $builders
     * @return array<string, BuilderInterface>
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
