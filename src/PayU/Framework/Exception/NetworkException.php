<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Framework\Exception;

/**
 * Class NetworkException
 *
 * @package PayUSdk\Framework\Exception
 */
class NetworkException extends \Exception
{
    /**
     * The url that was being connected to when the exception occurred
     *
     * @var string
     */
    private string $url;

    /**
     * Any response data that was returned by the server
     *
     * @var string
     */
    private string $data;

    /**
     * Default Constructor
     *
     * @param string $url
     * @param string $message
     * @param int $code
     */
    public function __construct($url, $message, $code = 0)
    {
        parent::__construct($message, $code);

        $this->url = $url;
    }

    /**
     * Gets Data
     *
     * @return string
     */
    public function getData(): string
    {
        return $this->data;
    }

    /**
     * Sets Data
     *
     * @param $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * Gets Url
     *
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }
}
