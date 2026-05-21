<?php

namespace PayU\Test\Handler;

use PayUSdk\Framework\Authentication;
use PayUSdk\Handler\GatewayConfigHandler;
use PayUSdk\Framework\Gateway\Config;
use PayUSdk\Framework\Soap\Context;

class BasicAuthHandlerTest extends \PHPUnit\Framework\TestCase
{
    protected $username = '100032';
    protected $password = 'PypWWegU';
    protected $safekey = '{CE62CE80-0EFD-4035-87C1-8824C5C46E7F}';

    /**
     * @var GatewayConfigHandler
     */
    public $handler;

    /**
     * @var Config
     */
    public $httpConfig;

    /**
     * @var Context
     */
    public $apiContext;

    /**
     * @var array
     */
    public $config;

    public function setUp(): void
    {
        $this->apiContext = new Context(
            new Authentication(
                $this->username,
                $this->password,
                $this->safekey
            ));
    }

    public function modeProvider()
    {
        return array(
            array( array('mode' => 'sandbox') ),
            array( array('mode' => 'live')),
            array( array( 'mode' => 'sandbox','oauth.EndPoint' => 'http://localhost/')),
            array( array('mode' => 'sandbox','service.EndPoint' => 'http://service.localhost/'))
        );
    }


    /**
     * @dataProvider modeProvider
     * @param $configs
     */
    public function testGetEndpoint($configs)
    {
        $config = $configs + array(
            'cache.enabled' => true,
            'http.headers.header1' => 'header1value'
        );
        $this->apiContext->setConfig($config);
        $this->httpConfig = new Config(null, 'doTransaction', $config);
        $this->handler = new GatewayConfigHandler($this->apiContext);
        $this->handler->handle($this->httpConfig);

        $this->assertNotEmpty($this->httpConfig->getHeaders());
        $this->assertNotEmpty($this->httpConfig->getGatewayUrl());
    }
}

