<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayU\Api;

/**
 * Interface CommandInterface
 *
 * @package PayU\Api
 */
interface CommandInterface
{
    /**
     * @param array $arguments
     * @return array
     */
    public function execute(array $arguments): array;
}
