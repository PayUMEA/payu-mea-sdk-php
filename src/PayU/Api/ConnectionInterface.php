<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayU\Api;

/**
 * Class ConnectionInterface
 *
 * @package PayU\Api
 */
interface ConnectionInterface
{
    /**
     * @param array $arguments connection arguments
     */
    public function execute(array $arguments);
}
