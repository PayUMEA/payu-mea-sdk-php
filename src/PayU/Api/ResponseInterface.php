<?php

/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Api;

/**
 * Interface ResponseInterface
 *
 * Payment gateway transaction response.
 *
 * @package PayUSdk\Api
 */
interface ResponseInterface
{
    /**
     * @return ?bool
     */
    public function getSuccessful(): ?bool;

    /**
     * @return ?string
     */
    public function getDisplayMessage(): ?string;

    /**
     * @return ?string
     */
    public function getPayUReference(): ?string;

    /**
     * @return ?string
     */
    public function getMerchantReference(): ?string;

    /**
     * @return ?string
     */
    public function getResultCode(): ?string;

    /**
     * @return ?string
     */
    public function getResultMessage(): ?string;
}
