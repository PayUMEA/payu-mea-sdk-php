<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayU\Api\Data;

/**
 * Interface Secure3DInterface
 *
 * Secure3d details
 *
 * @package PayU\Api\Data
 */
interface Secure3DInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case.
     */
    /*
     * Id.
     */
    const secure_3d_id = 'secure_3d_id';
    /*
     * Url.
     */
    const secure_3d_url = 'secure_3d_url';

    /**
     * @return string Secure 3D id
     */
    public function getId(): string;

    /**
     * @return string Secure 3D url
     */
    public function getUrl(): string;

    /**
     * @param string $id
     * @return $this
     */
    public function setId(string $id): static;

    /**
     * @param string $url
     * @return $this
     */
    public function setUrl(string $url): static;
}
