<?php

/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Api;

/**
 * Interface AdapterInterface
 *
 * @package PayUSdk\Api
 */
interface AdapterInterface
{
    /**
     * @param array<string, mixed> $arguments
     * @return ResponseInterface
     */
    public function get(array $arguments): ResponseInterface;

    /**
     * @param array<string, mixed> $arguments
     * @return ResponseInterface
     */
    public function setup(array $arguments): ResponseInterface;

    /**
     * @param array<string, mixed> $arguments
     * @return ResponseInterface
     */
    public function create(array $arguments): ResponseInterface;

    /**
     * @param array<string, mixed> $arguments
     * @return ResponseInterface
     */
    public function refund(array $arguments): ResponseInterface;

    /**
     * @param array<string, mixed> $arguments
     * @return ResponseInterface
     */
    public function capture(array $arguments): ResponseInterface;

    /**
     * @param array<string, mixed> $arguments
     * @return ResponseInterface
     */
    public function void(array $arguments): ResponseInterface;

    /**
     * @param array<string, mixed> $arguments
     * @return ResponseInterface
     */
    public function lookup(array $arguments): ResponseInterface;
}
