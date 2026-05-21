<?php

namespace PayU\Test\Http;

use PayUSdk\Framework\Gateway\Config;

/**
 * Test class for ConfigTest.
 *
 */
class ConfigTest extends \PHPUnit\Framework\TestCase
{

    protected $object;

    private $config = array(
        'http.connection_timeout' => '30',
        'http.retry' => '5',
    );

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void
    {
    }

    /**
     * @test
     */
    public function testHeaderFunctions()
    {
        $o = new Config();
        $o->addHeader('key1', 'value1');
        $o->addHeader('key2', 'value');
        $o->addHeader('key2', 'overwritten');

        $this->assertEquals(2, count($o->getHeaders()));
        $this->assertEquals('overwritten', $o->getHeader('key2'));
        $this->assertNull($o->getHeader('key3'));

        $o = new Config();
        $o->addHeader('key1', 'value1');
        $o->addHeader('key2', 'value');
        $o->addHeader('key2', 'and more', false);

        $this->assertEquals(2, count($o->getHeaders()));
        $this->assertEquals('value;and more', $o->getHeader('key2'));

        $o->removeHeader('key2');
        $this->assertEquals(1, count($o->getHeaders()));
        $this->assertNull($o->getHeader('key2'));
    }

    /**
     * @test
     */
    public function testUserAgent()
    {
        $ua = 'UAString';
        $o = new Config();
        $o->setUserAgent($ua);

        $curlOpts = $o->getSoapOptions();
        $this->assertEquals($ua, $curlOpts['user_agent']);
    }

    /**
     * @test
     */
    public function testSSLOpts()
    {
        $sslCert = '../cacert.pem';
        $sslPass = 'password';

        $o = new Config();
        $o->setSSLCert($sslCert, $sslPass);

        $curlOpts = $o->getSoapOptions();
        $this->assertArrayHasKey('local_cert', $curlOpts);
        $this->assertEquals($sslPass, $curlOpts['passphrase']);
    }

    /**
     * @test
     */
    public function testProxyOpts()
    {
        $proxy = 'http://me:secret@hostname:8081';

        $o = new Config();
        $o->setHttpProxy($proxy);

        $soapOpts = $o->getSoapOptions();
        $this->assertEquals('hostname', $soapOpts['proxy_host']);
        $this->assertEquals('8081', $soapOpts['proxy_port']);
        $this->assertEquals('me', $soapOpts['proxy_login']);
        $this->assertEquals('secret', $soapOpts['proxy_password']);

        $this->expectException(\PayUSdk\Framework\Exception\ConfigurationException::class);
        $o->setHttpProxy('invalid string');
    }
}
