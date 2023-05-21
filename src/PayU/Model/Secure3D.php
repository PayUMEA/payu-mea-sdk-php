<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayU\Model;

use PayU\Api\Data\Secure3DInterface;
use PayU\Framework\AbstractModel;

/**
 * Class Secure3D
 *
 * @package PayU\Api
 */
class Secure3D extends AbstractModel implements Secure3DInterface
{
    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->getData(Secure3DInterface::secure_3d_id);
    }

    /**
     * @return string Secure3D Url
     */
    public function getUrl(): string
    {
        return $this->getData(Secure3DInterface::secure_3d_url);
    }

    /**
     * @param string $id
     * @return $this|Secure3D
     */
    public function setId(string $id): static
    {
        return $this->setData(Secure3DInterface::secure_3d_id, $id);
    }

    /**
     * @param $url
     * @return $this
     */
    public function setUrl($url): static
    {
        return $this->setData(Secure3DInterface::secure_3d_url, $url);
    }
}

