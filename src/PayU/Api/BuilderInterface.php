<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayU\Api;

/**
 * Interface BuilderInterface
 * @package PayU\Api
 * @api
 */
interface BuilderInterface
{
    /**
     * Builds request payload
     *
     * @param array $buildSubject
     * @return array
     */
    public function build(array $buildSubject): array;
}
