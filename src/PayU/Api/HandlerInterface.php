<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayU\Api;

use PayU\Framework\Gateway\Config;

/**
 * Class HandlerInterface
 *
 * @package PayU\Api
 */
interface HandlerInterface
{
    /**
     *
     * @param Config $config
     * @return void
     */
    public function handle(Config $config): void;
}
