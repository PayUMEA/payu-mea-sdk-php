<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Api;

/**
 * Class ProcessorInterface
 *
 * Lets you process a transaction with the payment gateway.
 *
 * @package PayU\Adapter
 */
interface ProcessorInterface
{
    public static function processAction(string $action, ActionInterface $subject): ResponseInterface;
}
