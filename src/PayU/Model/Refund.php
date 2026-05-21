<?php

/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Model;

/**
 * Class Refund
 *
 * @package PayUSdk\Model
 */
class Refund extends PayUModel
{
    /**
     * @return ?string
     */
    public function getId(): ?string
    {
        return $this->getData('id');
    }

    /**
     * @param ?string $id
     * @return $this
     */
    public function setId(?string $id): static
    {
        return $this->setData('id', $id);
    }

    /**
     * @return ?string
     */
    public function getIntent(): ?string
    {
        return $this->getData('intent');
    }

    /**
     * @param ?string $intent
     * @return $this
     */
    public function setIntent(?string $intent): static
    {
        return $this->setData('intent', $intent);
    }

    /**
     * @return ?string
     */
    public function getPayUReference(): ?string
    {
        return $this->getData('pay_u_reference');
    }

    /**
     * @param ?string $payUReference
     * @return $this
     */
    public function setPayUReference(?string $payUReference): static
    {
        return $this->setData('pay_u_reference', $payUReference);
    }

    /**
     * @return ?string
     */
    public function getMerchantReference(): ?string
    {
        return $this->getData('merchant_reference');
    }

    /**
     * @param ?string $merchantReference
     * @return $this
     */
    public function setMerchantReference(?string $merchantReference): static
    {
        return $this->setData('merchant_reference', $merchantReference);
    }

    /**
     * @return mixed
     */
    public function getCustomer(): mixed
    {
        return $this->getData('customer');
    }

    /**
     * @param mixed $customer
     * @return $this
     */
    public function setCustomer(mixed $customer): static
    {
        return $this->setData('customer', $customer);
    }

    /**
     * @return mixed
     */
    public function getTransaction(): mixed
    {
        return $this->getData('transaction');
    }

    /**
     * @param mixed $transaction
     * @return $this
     */
    public function setTransaction(mixed $transaction): static
    {
        return $this->setData('transaction', $transaction);
    }

    /**
     * @return mixed
     */
    public function getMerchant(): mixed
    {
        return $this->getData('merchant');
    }

    /**
     * @param mixed $merchant
     * @return $this
     */
    public function setMerchant(mixed $merchant): static
    {
        return $this->setData('merchant', $merchant);
    }

    /**
     * @return mixed
     */
    public function getRedirectUrls(): mixed
    {
        return $this->getData('redirect_urls');
    }

    /**
     * @param mixed $redirectUrls
     * @return $this
     */
    public function setRedirectUrls(mixed $redirectUrls): static
    {
        return $this->setData('redirect_urls', $redirectUrls);
    }

    /**
     * @return Response
     */
    public function getReturn(): mixed
    {
        return $this->getData('return');
    }

    /**
     * @param mixed $return
     * @return $this
     */
    public function setReturn(mixed $return): static
    {
        return $this->setData('return', $return);
    }

    /**
     * @return mixed
     */
    public function getFmDetails(): mixed
    {
        return $this->getData('fm_details');
    }

    /**
     * @param mixed $fmDetails
     * @return $this
     */
    public function setFmDetails(mixed $fmDetails): static
    {
        return $this->setData('fm_details', $fmDetails);
    }

    /**
     * @return mixed
     */
    public function getTransactionRecord(): mixed
    {
        return $this->getData('transaction_record');
    }

    /**
     * @param mixed $transactionRecord
     * @return $this
     */
    public function setTransactionRecord(mixed $transactionRecord): static
    {
        return $this->setData('transaction_record', $transactionRecord);
    }

    protected static function executeCall(
        $method,
        $payLoad,
        $headers = [],
        $apiContext = null,
        $soapCall = null,
        $handlers = ['PayU\\Handler\\BasicAuthHandler'],
        $path = ''
    ) {
        if ($soapCall) {
            return $soapCall->execute($method, $payLoad, $handlers, $headers, $path);
        }
        return '{}';
    }

    public static function get($reference, $apiContext = null, $soapCall = null): static
    {
        $payload = [
            'AdditionalInformation' => [
                'payUReference' => $reference
            ]
        ];
        $json = self::executeCall('getTransaction', $payload, [], $apiContext, $soapCall);
        return new static($json);
    }

    public function refund($apiContext = null, $soapCall = null): static
    {
        $json = self::executeCall('doTransaction', $this->toArray(), [], $apiContext, $soapCall);
        $this->fromJson($json);
        return $this;
    }
}
