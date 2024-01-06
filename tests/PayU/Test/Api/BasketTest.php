<?php
/**
 * Created by PhpStorm.
 * User: kenny
 * Date: 12/19/16
 * Time: 10:23 AM
 */

namespace PayU\Test\Api;

use PayUSdk\Api\Basket;

class BasketTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Gets Object Instance with Json data filled in
     * @return Basket
     */
    public static function getObject()
    {
        return new Basket(self::getJson());
    }

    /**
     * Gets Json String of Object Address
     * @return string
     */
    public static function getJson()
    {
        return '{"amountInCents":"20000","currencyCode":"ZAR","description":"TestSample"}';
    }

    /**
     * Tests for Serialization and Deserialization Issues
     * @return Basket
     */
    public function testSerializationDeserialization()
    {
        $obj = new Basket(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getAmountInCents());
        $this->assertNotNull($obj->getCurrencyCode());
        $this->assertNotNull($obj->getDescription());
        $this->assertEquals(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @depends testSerializationDeserialization
     * @param Basket $obj
     */
    public function testGetters($obj)
    {
        $this->assertEquals($obj->getAmountInCents(), "20000");
        $this->assertEquals($obj->getCurrencyCode(), "ZAR");
        $this->assertEquals($obj->getDescription(), "TestSample");
    }
}
