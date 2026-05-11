<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Framework\Gateway;

use PayUSdk\Framework\Soap\Context;
use PayUSdk\Framework\XMLHelper;
use SoapClient;
use SoapFault;
use SOAPHeader;
use SoapVar;

/**
 * Class SoapClient
 *
 * @package PayUSdk\Framework\Gateway
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
    }

    /**
     * Execute SOAP method on the client
     *
     * @param string $methodName the soap call method to execute
     * @param array<string, mixed> $payload the payment transaction details
     * @param array<int, string> $httpHeaders
     *
     * @return array<string, mixed>
     */
    public function doAction(string $methodName, array $payload, array $httpHeaders): array
    {
        $this->setHttpHeader($httpHeaders);
        assert(self::$soapClient instanceof \SoapClient);
        self::$soapClient->__setSoapHeaders($this->getAuthHeader());
        /** @var mixed $response */
        $response = self::$soapClient->$methodName($payload);

        $json = json_encode($response);
        if ($json === false) {
             return [];
        }

        return (array)json_decode($json, true);
    }

    /**
     * Set HTTP headers passed to the request
     *
     * @param array<int, string> $httpHeaders
     */
    private function setHttpHeader(array $httpHeaders): void
    {
        stream_context_set_options(
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
     * @return \SoapHeader
     */
    private function getAuthHeader(): \SoapHeader
    {
        $credential = $this->apiContext->getCredential();
        assert($credential !== null);

        $header = '<wsse:Security SOAP-ENV:mustUnderstand="1" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">';
        $header .= '<wsse:UsernameToken wsu:Id="UsernameToken-9" xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">';
        $header .= '<wsse:Username>' . $credential->getUsername() . '</wsse:Username>';
        $header .= '<wsse:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText">' . $credential->getPassword() . '</wsse:Password>';
        $header .= '</wsse:UsernameToken>';
        $header .= '</wsse:Security>';

        $headerBody = new \SoapVar($header, XSD_ANYXML, null, null, null);

        return new \SoapHeader(self::PAYU_NAMESPACE, 'Security', $headerBody, true);
    }

    /**
     * @return string
     */
    public function debugLog(): string
    {
        assert(self::$soapClient instanceof \SoapClient);
        $string = "\n\n" . "SOAP CALL REQUEST HEADERS: \n" . $this->prettyPrintXml((string)self::$soapClient->__getLastRequestHeaders());
        $string .= "\n\n" . "SOAP CALL REQUEST: \n" . $this->prettyPrintXml((string)self::$soapClient->__getLastRequest());
        $string .= "\n\n" . "SOAP CALL RESPONSE HEADERS: \n" . $this->prettyPrintXml((string)self::$soapClient->__getLastResponseHeaders());
        $string .= "\n\n" . "SOAP CALL RESPONSE: \n" . $this->prettyPrintXml((string)self::$soapClient->__getLastResponse());
        $string .= "\n\n";

        return $string;
    }

    /**
     * @param string $xml
     * @return string
     */
    private function prettyPrintXml(string $xml): string {
        return (new XMLHelper())->prettyPrint($xml);
    }
}
