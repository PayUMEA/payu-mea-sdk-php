<?php
/**
 * Created by PhpStorm.
 * User: kenny
 * Date: 12/19/16
 * Time: 10:23 AM
 */

namespace PayU\Test\Api;

use PayU\Test\Api\Helper;

use PayUSdk\Model\Basket;

class BasketTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Gets Object Instance with Json data filled in
     * @return Basket
     */
        /**
     * Gets array data representation of the object
     * @return array
     */
    public static function getData()
    {
        return Helper::hydrateData(json_decode(self::getJson(), true));
    }

    public static function getObject()
    {
        return new Basket(self::getData());
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
        $obj = new Basket(self::getData());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getAmountInCents());
        $this->assertNotNull($obj->getCurrencyCode());
        $this->assertNotNull($obj->getDescription());
        $this->assertEquals(self::getObject(), $obj);
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
