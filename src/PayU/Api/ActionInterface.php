<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayU\Api;

/**
 * Class ActionInterface
 *
 * The action to carry out on the payment gateway. It can be
 * a payment, refund or void action.
 *
 * @package PayU\Api
 */
interface ActionInterface
{
    /**
     * @param string $action
     * @return ResponseInterface
     */
    public function execute(string $action): ResponseInterface;
}
