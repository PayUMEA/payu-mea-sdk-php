<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace PayU\Http;

use PayU\Soap\ApiContext;
use SoapClient;
use SoapFault;
use SOAPHeader;
use SoapVar;

/**
 * Class SoapClient
 *
 * @package PayU\Client
 * @copyright  Copyright (c) 2016 PayU
 * @license    http://opensource.org/licenses/LGPL-3.0  Open Software License (LGPL 3.0)
 * @link http://www.payu.co.za
 * @link http://help.payu.co.za/developers
 * @author Kenneth Onah <kenneth@netcraft-devops.com>
 */
class PayUSoapClient
{
    const API_VERSION = 'ONE_ZERO';
    const PAYU_NAMESPACE = 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd';

    /**
     * @var ?SoapClient
     */
    private static ?SoapClient $soapClient = null;

    /**
     * @var ApiContext
     */
    private ApiContext $apiContext;

    /**
     * @var Config
     */
    private Config $httpConfig;

    /**
     * @var resource
     */
    private $streamContext;

    /**
     * PayUSoapClient constructor.
     *
     * @param ApiContext $apiContext
     * @param Config $httpConfig
     * @throws SoapFault
     */
    public function __construct(ApiContext $apiContext, Config $httpConfig)
    {
        $this->apiContext = $apiContext;
        $this->httpConfig = $httpConfig;
        $this->streamContext = stream_context_create();

        // Create the stream_context and add it to the options
        $options = array_merge($httpConfig->getSoapOptions(), ['stream_context' => $this->streamContext]);

        // Create new SOAP client
        if (null === self::$soapClient) {
            self::$soapClient = new SoapClient($httpConfig->getEndpointUrl(), $options);
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
     * @return string
     */
    public function doAction(string $methodName, array $payload, array $httpHeaders): string
    {
        $this->setHttpHeader($httpHeaders);
        self::$soapClient->__setSoapHeaders($this->getAuthHeader());
        $response = self::$soapClient->$methodName($payload);

        return json_encode($response);
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

    public function debugLog(): string
    {
        $string = "\n\n" . "SOAP CALL REQUEST HEADERS: " . self::$soapClient->__getLastRequestHeaders();
        $string .= "\n\n" . "SOAP CALL REQUEST: " . self::$soapClient->__getLastRequest();
        $string .= "\n\n" . "SOAP CALL RESPONSE HEADERS: " . self::$soapClient->__getLastResponseHeaders();
        $string .= "\n\n" . "SOAP CALL RESPONSE: " . self::$soapClient->__getLastResponse();

        return $string;
    }
}
