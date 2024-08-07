<?php
/**
 * Created by PhpStorm.
 * User: kenny
 * Date: 12/19/16
 * Time: 12:30 PM
 */

namespace PayU\Test\Api;

use PayUSdk\Api\ItemList;

class ItemListTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Gets Json String of Object ItemList
     * @return string
     */
    public static function getJson()
    {
        return '{"items":' . ItemTest::getJson() . ',"shippingAddress":' . ShippingAddressTest::getJson() . ',"shippingMethod":"TestSample","shippingPhoneNumber":"TestSample"}';
    }

    /**
     * Gets Object Instance with Json data filled in
     * @return ItemList
     */
    public static function getObject()
    {
        return new ItemList(self::getJson());
    }


    /**
     * Tests for Serialization and Deserialization Issues
     * @return ItemList
     */
    public function testSerializationDeserialization()
    {
        $obj = new ItemList(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getItems());
        $this->assertNotNull($obj->getShippingAddress());
        $this->assertNotNull($obj->getShippingMethod());
        $this->assertNotNull($obj->getShippingPhoneNumber());
        $this->assertEquals(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @depends testSerializationDeserialization
     * @param ItemList $obj
     */
    public function testGetters($obj)
    {
        $this->assertEquals($obj->getItems(), ItemTest::getObject());
        $this->assertEquals($obj->getShippingAddress(), ShippingAddressTest::getObject());
        $this->assertEquals($obj->getShippingMethod(), "TestSample");
        $this->assertEquals($obj->getShippingPhoneNumber(), "TestSample");
    }
}
