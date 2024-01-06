<?php
/**
 * Created by PhpStorm.
 * User: kenny
 * Date: 12/19/16
 * Time: 10:23 AM
 */

namespace PayU\Test\Api;

use PayUSdk\Api\ShippingCost;

class ShippingCostTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Gets Object Instance with Json data filled in
     * @return ShippingCost
     */
    public static function getObject()
    {
        return new ShippingCost(self::getJson());
    }

    /**
     * Gets Json String of Object Address
     * @return string
     */
    public static function getJson()
    {
        return '{"amount":' . AmountTest::getJson() . ',"tax":' . TaxTest::getJson() . '}';
    }

    /**
     * Tests for Serialization and Deserialization Issues
     * @return ShippingCost
     */
    public function testSerializationDeserialization()
    {
        $obj = new ShippingCost(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getAmount());
        $this->assertNotNull($obj->getTax());
        $this->assertEquals(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @depends testSerializationDeserialization
     * @param ShippingCost $obj
     */
    public function testGetters($obj)
    {
        $this->assertEquals($obj->getAmount(), AmountTest::getObject());
        $this->assertEquals($obj->getTax(), TaxTest::getObject());;
    }
}
