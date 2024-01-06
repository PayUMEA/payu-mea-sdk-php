<?php

namespace PayU\Test\Handler;

use PayU\Auth\BasicAuth;
use PayUSdk\Handler\BasicAuthHandler;
use PayU\Http\Config;
use PayU\Soap\ApiContext;

class BasicAuthHandlerTest extends \PHPUnit_Framework_TestCase
{
    protected $username = '100032';
    protected $password = 'PypWWegU';
    protected $safekey = '{CE62CE80-0EFD-4035-87C1-8824C5C46E7F}';

    /**
     * @var BasicAuthHandler
     */
    public $handler;

    /**
     * @var Config
     */
    public $httpConfig;

    /**
     * @var ApiContext
     */
    public $apiContext;

    /**
     * @var array
     */
    public $config;

    public function setUp()
    {
        $this->apiContext = new ApiContext(
            new BasicAuth(
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
        $this->httpConfig = new Config(null, 'POST', $config);
        $this->handler = new BasicAuthHandler($this->apiContext);
        $this->handler->handle($this->httpConfig, null, $this->config);
    }
}
