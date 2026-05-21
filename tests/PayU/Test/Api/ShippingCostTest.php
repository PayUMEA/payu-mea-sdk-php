<?php
/**
 * Created by PhpStorm.
 * User: kenny
 * Date: 12/19/16
 * Time: 10:23 AM
 */

namespace PayU\Test\Api;

use PayU\Test\Api\Helper;

use PayUSdk\Model\ShippingCost;

class ShippingCostTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Gets Object Instance with Json data filled in
     * @return ShippingCost
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
        return new ShippingCost(self::getData());
    }

    /**
     * Gets Json String of Object Address
     * @return string
     */
    public static function getJson()
    {
        return '{"amount":' . TotalTest::getJson() . ',"tax":' . TaxTest::getJson() . '}';
    }

    /**
     * Tests for Serialization and Deserialization Issues
     * @return ShippingCost
     */
    public function testSerializationDeserialization()
    {
        $obj = new ShippingCost(self::getData());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getAmount());
        $this->assertNotNull($obj->getTax());
        $this->assertEquals(self::getObject(), $obj);
        return $obj;
    }

    /**
     * @depends testSerializationDeserialization
     * @param ShippingCost $obj
     */
    public function testGetters($obj)
    {
        $this->assertEquals($obj->getAmount(), TotalTest::getObject());
        $this->assertEquals($obj->getTax(), TaxTest::getObject());;
    }
}
