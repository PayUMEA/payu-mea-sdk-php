<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Framework;

use PayUSdk\Api\ActionInterface;
use PayUSdk\Api\ProcessorInterface;
use PayUSdk\Api\ResponseInterface;

/**
 * Class Payment
 *
 * Lets you create, process and manage payments.
 *
 * @package PayU\Adapter
 */
class Processor implements ProcessorInterface
{
    /**
     * @param string $action
     * @param ActionInterface $subject
     * @return ResponseInterface
     */
    public static function processAction(string $action, ActionInterface $subject): ResponseInterface
    {
        return $subject->execute($action);
    }
}
