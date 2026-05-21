<?php
/**
 * Copyright © 2026 PayU Financial Services. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace PayU\Test\Api;

use PayUSdk\Model\Currency;

class CurrencyTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Gets Object Instance
     * @return Currency
     */
    public static function getObject()
    {
        return new Currency(self::getData());
    }

    /**
     * @return array
     */
    public static function getData()
    {
        return ["code" => "ZAR"];
    }

    /**
     * @return string
     */
    public static function getJson()
    {
        return '{"code":"ZAR"}';
    }

    /**
     * Tests for Serialization and Deserialization Issues
     * @return Currency
     */
    public function testSerializationDeserialization()
    {
        $currency = new Currency(self::getData());
        $this->assertNotNull($currency);
        $this->assertNotNull($currency->getCode());
        $this->assertEquals(self::getObject(), $currency);
        return $currency;
    }

    /**
     * @depends testSerializationDeserialization
     * @param Currency $currency
     */
    public function testGetters(Currency $currency)
    {
        $this->assertEquals($currency->getCode(), "ZAR");
    }

    /**
     * @depends testSerializationDeserialization
     * @param Currency $currency
     */
    public function testSetters(Currency $currency)
    {
        $currency->setCode("NGN");
        $this->assertEquals($currency->getCode(), "NGN");
    }
}
