<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Api;

/**
 * Class ConnectionInterface
 *
 * @package PayUSdk\Api
 */
interface ConnectionInterface
{
    /**
     * @param array $arguments connection arguments
     */
    public function execute(array $arguments);
}
