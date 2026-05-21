<?php

/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Model;

/**
 * Class RedirectUrls
 *
 * Backward-compatibility wrapper for legacy RedirectUrls configuration.
 *
 * @package PayUSdk\Model
 */
class RedirectUrls extends TransactionUrl
{
    /**
     * @return string|null
     */
    public function getNotifyUrl(): ?string
    {
        return $this->getNotificationUrl();
    }

    /**
     * @param string|null $notifyUrl
     * @return $this
     */
    public function setNotifyUrl(?string $notifyUrl): static
    {
        return $this->setNotificationUrl($notifyUrl);
    }

    /**
     * @return string|null
     */
    public function getReturnUrl(): ?string
    {
        return $this->getResponseUrl();
    }

    /**
     * @param string|null $returnUrl
     * @return $this
     */
    public function setReturnUrl(?string $returnUrl): static
    {
        return $this->setResponseUrl($returnUrl);
    }
}
