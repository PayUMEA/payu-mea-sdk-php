<?php

/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Api\Data;

/**
 * Interface TransactionUrlInterface
 *
 * Set of payment transaction URLs.
 *
 * @package PayUSdk\Api\Data
 */
interface TransactionUrlInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case.
     */
    /*
     * PayU response url.
     */
    public const RESPONSE_URL = 'return_url';
    /*
     * PayU Cancel url.
     */
    public const CANCEL_URL = 'cancel_url';
    /*
     * PayU Instant Payment Notification (IPN) url.
     */
    public const NOTIFICATION_URL = 'notification_url';

    /**
     * Url where the customer should be redirected to after approving the payment
     * @return string|null Payment transaction response url
     */
    public function getResponseUrl(): ?string;

    /**
     * Url where the customer should be redirected to after canceling the payment.
     * @return string|null Payment transaction cancel url
     */
    public function getCancelUrl(): ?string;

    /**
     * Url where the Instant Payment Notification requests are sent.
     * @return string|null Payment transaction notification url
     */
    public function getNotificationUrl(): ?string;

    /**
     * @param string|null $responseUrl
     * @return $this
     */
    public function setResponseUrl(?string $responseUrl): static;

    /**
     * @param string|null $cancelUrl
     * @return $this
     */
    public function setCancelUrl(?string $cancelUrl): static;

    /**
     * @param string|null $notificationUrl
     * @return $this
     */
    public function setNotificationUrl(?string $notificationUrl): static;
}
