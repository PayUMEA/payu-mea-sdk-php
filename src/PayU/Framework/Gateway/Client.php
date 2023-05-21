<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayU\Framework\Gateway;

use PayU\Framework\Soap\Context;
use SoapClient;
use SoapFault;
use SOAPHeader;
use SoapVar;

/**
 * Class SoapClient
 *
 * @package PayU\Framework\Gateway
 */
class Client
{
    const API_VERSION = 'ONE_ZERO';
    const PAYU_NAMESPACE = 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd';

    /**
     * @var ?SoapClient
     */
    private static ?SoapClient $soapClient = null;

    /**
     * @var resource
     */
    private $streamContext;

    /**
     * Client constructor.
     *
     * @param Context $apiContext
     * @param Config $httpConfig
     * @throws SoapFault
     */
    public function __construct(
        protected readonly Context $apiContext,
        protected readonly Config  $httpConfig
    ) {
        $this->streamContext = stream_context_create();

        // Create the stream_context and add it to the options
        $options = array_merge($httpConfig->getSoapOptions(), ['stream_context' => $this->streamContext]);

        // Create new SOAP client
        if (null === self::$soapClient) {
            self::$soapClient = new SoapClient($httpConfig->getGatewayUrl(), $options);
        }

        return $this;
    }

    /**
     * Execute SOAP method on the client
     *
     * @param string $methodName the soap call method to execute
     * @param array $payload the payment transaction details
     * @param array $httpHeaders
     *
     * @return array
     */
    public function doAction(string $methodName, array $payload, array $httpHeaders): array
    {
        $this->setHttpHeader($httpHeaders);
        self::$soapClient->__setSoapHeaders($this->getAuthHeader());
        $response = self::$soapClient->$methodName($payload);

        return json_decode(json_encode($response), true);
    }

    /**
     * Set HTTP headers passed to the request
     *
     * @param array $httpHeaders
     */
    private function setHttpHeader(array $httpHeaders): void
    {
        stream_context_set_option(
            $this->streamContext, [
                'http' => [
                    'header' => $httpHeaders
                ],
                'ssl' => [
                    'ciphers' => 'DEFAULT:!TLSv1.0:!SSLv3'
                ],
            ]
        );
    }

    /**
     * SOAP Authentication header for SOAP client
     *
     * @return SOAPHeader
     */
    private function getAuthHeader(): SOAPHeader
    {
        $credential = $this->apiContext->getCredential();

        $header = '<wsse:Security SOAP-ENV:mustUnderstand="1" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">';
        $header .= '<wsse:UsernameToken wsu:Id="UsernameToken-9" xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">';
        $header .= '<wsse:Username>' . $credential->getUsername() . '</wsse:Username>';
        $header .= '<wsse:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText">' . $credential->getPassword() . '</wsse:Password>';
        $header .= '</wsse:UsernameToken>';
        $header .= '</wsse:Security>';

        $headerBody = new SoapVar($header, XSD_ANYXML, null, null, null);

        return new SOAPHeader(self::PAYU_NAMESPACE, 'Security', $headerBody, true);
    }

    /**
     * @return string
     */
    public function debugLog(): string
    {
        $string = "\n\n" . "SOAP CALL REQUEST HEADERS: " . self::$soapClient->__getLastRequestHeaders();
        $string .= "\n\n" . "SOAP CALL REQUEST: " . self::$soapClient->__getLastRequest();
        $string .= "\n\n" . "SOAP CALL RESPONSE HEADERS: " . self::$soapClient->__getLastResponseHeaders();
        $string .= "\n\n" . "SOAP CALL RESPONSE: " . self::$soapClient->__getLastResponse();

        return $string;
    }
}
