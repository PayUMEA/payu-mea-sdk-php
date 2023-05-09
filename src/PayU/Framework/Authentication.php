<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayU\Framework;

/**
 * Class Authentication
 *
 * @package PayU\Auth
 */
class Authentication
{
    /**
     * Construct
     *
     * @param string $username web service username obtained from the safe shop portal
     * @param string $password web service password obtained from the safe shop portal
     * @param string $safekey safe key obtained from the safe shop portal
     */
    public function __construct(
        protected string $username,
        protected string $password,
        protected string $safekey
    ) {
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Get safe key
     *
     * @return string
     */
    public function getSafekey(): string
    {
        return $this->safekey;
    }
}
