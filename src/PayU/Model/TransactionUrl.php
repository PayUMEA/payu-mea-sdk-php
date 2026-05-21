<?php

/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Model;

use InvalidArgumentException;
use PayUSdk\Api\Data\TransactionUrlInterface;
use PayUSdk\Framework\AbstractModel;
use PayUSdk\Framework\Validation\UrlValidator;

/**
 * Class TransactionUrl
 *
 * @package PayUSdk\Model
 */
class TransactionUrl extends AbstractModel implements TransactionUrlInterface
{
    /**
     * @return string|null
     */
    public function getResponseUrl(): ?string
    {
        return $this->getData(TransactionUrlInterface::RESPONSE_URL);
    }

    /**
     * @return string|null
     */
    public function getCancelUrl(): ?string
    {
        return $this->getData(TransactionUrlInterface::CANCEL_URL);
    }

    /**
     * @return string|null
     */
    public function getNotificationUrl(): ?string
    {
        return $this->getData(TransactionUrlInterface::NOTIFICATION_URL);
    }

    /**
     * @param string|null $responseUrl
     * @return $this
     */
    public function setResponseUrl(?string $responseUrl): static
    {
        UrlValidator::validate($responseUrl, "ResponseUrl");

        return $this->setData(TransactionUrlInterface::RESPONSE_URL, $responseUrl);
    }

    /**
     * @param string|null $cancelUrl
     * @return $this
     * @throws InvalidArgumentException
     */
    public function setCancelUrl(?string $cancelUrl): static
    {
        UrlValidator::validate($cancelUrl, "CancelUrl");

        return $this->setData(TransactionUrlInterface::CANCEL_URL, $cancelUrl);
    }

    /**
     * @param string|null $notificationUrl
     * @return $this
     * @throws InvalidArgumentException
     */
    public function setNotificationUrl(?string $notificationUrl): static
    {
        UrlValidator::validate($notificationUrl, "NotificationUrl");

        return $this->setData(TransactionUrlInterface::NOTIFICATION_URL, $notificationUrl);
    }
}
