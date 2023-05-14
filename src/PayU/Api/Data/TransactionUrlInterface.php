<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayU\Api\Data;

/**
 * Interface TransactionUrlInterface
 *
 * Set of payment transaction URLs.
 *
 * @package PayU\Api\Data
 */
interface TransactionUrlInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case.
     */
    /*
     * PayU response url.
     */
    const RESPONSE_URL = 'return_url';
    /*
     * PayU Cancel url.
     */
    const CANCEL_URL = 'cancel_url';
    /*
     * PayU Instant Payment Notification (IPN) url.
     */
    const NOTIFICATION_URL = 'notification_url';

    /**
     * Url where the customer should be redirected to after approving the payment
     * @return string Payment transaction response url
     */
    public function getResponseUrl(): string;

    /**
     * Url where the customer should be redirected to after canceling the payment.
     * @return string Payment transaction cancel url
     */
    public function getCancelUrl(): string;

    /**
     * Url where the Instant Payment Notification requests are sent.
     * @return string Payment transaction notification url
     */
    public function getNotificationUrl(): string;

    /**
     * @param string $responseUrl
     * @return $this
     */
    public function setResponseUrl(string $responseUrl): static;

    /**
     * @param string $cancelUrl
     * @return $this
     */
    public function setCancelUrl(string $cancelUrl): static;

    /**
     * @param string $notificationUrl
     * @return $this
     */
    public function setNotificationUrl(string $notificationUrl): static;
}
